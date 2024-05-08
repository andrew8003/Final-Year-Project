<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewdetailspages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="favicon.png">
    <title>View Users</title>
</head>
<body>
<?php
session_start();
    // Check if the user is authenticated and has correct permissions to view the page
    if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
        include("header.php");
        include("db.php");

        // Define the default sorting column and order
        $sortColumn = "user_id"; // sorting column
        $sortOrder = "ASC"; // sorting order

        // Check if a sorting parameter is provided in the URL
        if (isset($_GET['sort'])) {
            // Validate the sorting parameter to prevent SQL injection
            $validColumns = array("user_id", "usertype", "username", "account_disabled");
            if (in_array($_GET['sort'], $validColumns)) {
                $sortColumn = $_GET['sort'];
            }
        }

        // Check if a sorting order parameter is provided in the URL
        if (isset($_GET['order'])) {
            // Validate the sorting order parameter
            if ($_GET['order'] === 'ASC' || $_GET['order'] === 'DESC') {
                $sortOrder = $_GET['order'];
            }
        }

        // Initialize search query
        $searchQuery = "";

        // Check if a search query is provided
        if (isset($_GET['search'])) {
            $search = mysqli_real_escape_string($conn, $_GET['search']);
            $search = strtolower($search); // Convert search query to lowercase
            // alow search query to be able to search for partial words, and non case sensitive
            $searchQuery = "WHERE LOWER(user_id) LIKE '%$search%' OR LOWER(username) LIKE '%$search%' OR LOWER(usertype) LIKE '%$search%' OR LOWER(email) LIKE '%$search%' OR LOWER(telephone) LIKE '%$search%'";
        }

        // Fetch user data from the database with sorting and search
        $sql = "SELECT user_id, usertype, username, account_disabled 
                FROM inventory_system 
                $searchQuery
                ORDER BY $sortColumn $sortOrder";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<h2 class='text-heading'>Search For User And Click To See More Details And Edit</h2>";
            echo "
            <div class='table-controls'>
                <table>
                    <tr>
                        <td>
                            <div class='dropdown'>
                                <select id='sortby'>
                                    <option value='user_id-ASC'>User ID - Ascending</option>
                                    <option value='user_id-DESC'>User ID - Descending</option>
                                    <option value='usertype-ASC'>User Type - Ascending</option>
                                    <option value='usertype-DESC'>User Type - Descending</option>
                                    <option value='username-ASC'>Username - Ascending</option>
                                    <option value='username-DESC'>Username - Descending</option>
                                    <option value='account_disabled-ASC'>Account Disabled - Ascending</option>
                                    <option value='account_disabled-DESC'>Account Disabled - Descending</option>
                                </select>
                                <button onclick='sortTable()'>Sort</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>";
            echo "<div class='table-controls'>
            <table>
            <td>
                <div class='search-container'>
                    <form action='' method='GET'>
                        <input type='text' name='search' placeholder='Search users...'>
                        <button type='submit'>Search</button>
                    </form>
                </div>
            </td>
                </tr>
            </table>
        </div>";
            echo "
            <div class='user-container'>
                <div class='user-details'>
                    <table border='1'>
                        <tr>
                            <th>User ID</th>
                            <th>User Type</th>
                            <th>Username</th>
                            <th>Account Disabled (0 = No 1 = Yes)</th>
                        </tr>";

                    // Output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        // Display each user's data in a row
                        echo "<tr onclick='viewUserDetails(".$row["user_id"].")'>";
                        echo "<td>".$row["user_id"]."</td>
                            <td>".$row["usertype"]."</td>
                            <td>".$row["username"]."</td>
                            <td>".$row["account_disabled"]."</td>
                        </tr>";
                    }
            echo "</table>";
        } else {
            // Display message when no assets are found
            echo "<h3 class='text-heading'>Search For Asset And Click To See More Details And Edit</h3>";
            echo "<div class='table-controls'>
                <table>
                    <tr>
                    <td>
                    <div class='dropdown'>
                        <select id='sortby'>
                            <option value='user_id-ASC'>User ID - Ascending</option>
                            <option value='user_id-DESC'>User ID - Descending</option>
                            <option value='usertype-ASC'>User Type - Ascending</option>
                            <option value='usertype-DESC'>User Type - Descending</option>
                            <option value='username-ASC'>Username - Ascending</option>
                            <option value='username-DESC'>Username - Descending</option>
                            <option value='account_disabled-ASC'>Account Disabled - Ascending</option>
                            <option value='account_disabled-DESC'>Account Disabled - Descending</option>
                        </select>
                        <button onclick='sortTable()'>Sort</button>
                    </div>
                </td>
                    </tr>
                </table>
            </div>";
            echo "<div class='table-controls'>
            <table>
            <td>
                <div class='search-container'>
                    <form action='' method='GET'>
                        <input type='text' name='search' placeholder='Search users...'>
                        <button type='submit'>Search</button>
                    </form>
                </div>
            </td>
                </tr>
            </table>
        </div>";
            echo "<div class='user-container'>
                <div class='user-details'>
                    <table border='1'>
                        <tr>
                            <th>Asset Name</th>
                            <th>Asset Location</th>
                            <th>Asset Group</th>
                            <th>Date Added</th>
                        </tr>
                        <tr>
                            <td colspan='4'>No assets found.</td>
                        </tr>
                    </table>
                </div>
            </div>";
        }
        mysqli_close($conn);
    }else{
        echo "<!DOCTYPE html>
        <head>
        </head>
        <body>
            <script>
                setTimeout(function() {
                    window.location.href = 'accessdenied.php'; // Redirect to the login page
                }, 0);
            </script>
        </body>
        </html>";
        exit();
    }
    ?>
    <?php include("footer.php"); ?>

    <script>
        function sortTable() {
            var selectBox = document.getElementById("sortby");
            var selectedOption = selectBox.options[selectBox.selectedIndex].value;
            var sortParams = selectedOption.split("-");
            var selectedColumn = sortParams[0];
            var selectedOrder = sortParams[1];
            // Redirect to the same page with the sorted table
            window.location.href = 'view_users.php?sort=' + selectedColumn + '&order=' + selectedOrder;
        }

        function returnToPreviousPage() {
            history.back(); // This will take the user back to the previous page
        }

        function viewUserDetails(userId) {
            // Redirect to the user details page when a row is clicked
            window.location.href = 'user_details.php?user_id=' + userId;
        }
    </script>
</body>
</html>
