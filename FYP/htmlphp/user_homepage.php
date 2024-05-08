<?php
session_start();

/// Check if the user is authenticated and has correct permissions to view the page
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
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
    exit;
}

include("db.php");

// Fetch the account_disabled value from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT account_disabled FROM inventory_system WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $account_disabled = $row['account_disabled'];

    if ($account_disabled == 1) {
        // User's account is disabled, display account disabled text and hide all other content on the page
        $accountDisabled = true;
    } else {
        $accountDisabled = false;
    }
}

// Check if the user is currently borrowing an asset
$query_borrowing = "SELECT * FROM inventory_system_borrowing WHERE user_id = $user_id AND return_date IS NULL";
$result_borrowing = mysqli_query($conn, $query_borrowing);

if (mysqli_num_rows($result_borrowing) > 0) {
    // User is currently borrowing an asset, redirect to the currently borrowing page as they cannot borrow more than one asset at a time
    header("Location: user_currently_borrowing.php");
    exit();
}

// get all assets that are available for borrowing
$query_assets_all = "SELECT asset_id, asset_name, asset_description, asset_location FROM inventory_system_assets WHERE available_borrowing = 'Yes' AND currently_borrowed = 'No'";
$result_assets_all = mysqli_query($conn, $query_assets_all);

// Fetch asset data based on search term if provided
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$query_assets_filtered = $query_assets_all; // on load assume blank search
if (!empty($searchTerm)) {
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm); // Escape search term to prevent SQL injection
    // alow search query to be able to search for partial words, and non case sensitive
    $query_assets_filtered .= " AND (LOWER(asset_name) LIKE LOWER('%$searchTerm%') OR LOWER(asset_description) LIKE LOWER('%$searchTerm%') OR LOWER(asset_location) LIKE LOWER('%$searchTerm%'))";
}
$result_assets = mysqli_query($conn, $query_assets_filtered);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userhomepage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="image/x-icon">
    <title>User Dashboard</title>
    <script>
        function sortTable() {
            var selectElement = document.getElementById("sortby");
            var selectedOption = selectElement.value;
            var sortingCriteria = selectedOption.split("-")[0];
            var sortOrder = selectedOption.split("-")[1];

            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.querySelector(".assets-container table");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < rows.length - 1; i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[sortingCriteria].textContent;
                    y = rows[i + 1].getElementsByTagName("td")[sortingCriteria].textContent;

                    if ((sortOrder === "ASC" && x.toLowerCase() > y.toLowerCase()) ||
                        (sortOrder === "DESC" && x.toLowerCase() < y.toLowerCase())) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
    </script>
</head>
<body>
    <?php include("user_header.php"); ?>

    <?php if ($accountDisabled) : ?>
        <div class="account-disabled-message">
            Account disabled - Please contact support for assistance.
        </div>
    <?php else : ?>

        <div class="video-container">
            <div class="white-box"></div>
            <video autoplay muted loop id="video-bg">
                <source src="media/background.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="assets-container">
            <h2 class="text-heading">Available To Borrow</h2>
            <br><br>
            <h3>To Borrow Find The Device Below And Click On It</h3>
        </div>
        <div class="table-controls">
            <table>
                <tr>
                    <td>
                        <div class="dropdown">
                            <select id="sortby">
                                <option value="0-ASC">Name - Ascending</option>
                                <option value="0-DESC">Name - Descending</option>
                                <option value="2-ASC">Location - Ascending</option>
                                <option value="2-DESC">Location - Descending</option>
                            </select>
                            <button onclick="sortTable()">Sort</button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="table-controls">
            <table>
                <tr>
                    <td>
                        <div class="search-container">
                            <form action="" method="GET">
                                <input type="text" name="search" placeholder="Search assets">
                                <button type="submit">Search</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Asset table -->
        <div class="assets-container">
            <table>
                <tr>
                    <th>Asset Name</th>
                    <th>Asset Description</th>
                    <th>Asset Location</th>
                </tr>
                <?php
                if (mysqli_num_rows($result_assets) > 0) {
                    while ($row_assets = mysqli_fetch_assoc($result_assets)) {
                        echo "<tr onclick=\"window.location='user_borrow_page.php?asset_id=" . urlencode($row_assets['asset_id']) . "'\">";
                        echo "<td>" . ($row_assets["asset_name"] ? $row_assets["asset_name"] : "empty") . "</td>";
                        echo "<td>" . ($row_assets["asset_description"] ? $row_assets["asset_description"] : "empty") . "</td>";
                        echo "<td>" . ($row_assets["asset_location"] ? $row_assets["asset_location"] : "empty") . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No results found. Please try again.</td></tr>";
                }
                ?>
            </table>
        </div>

    <?php endif; ?>

    <?php 
    mysqli_close($conn); 
    ?>
    
    <?php include("footer.php"); ?>
</body>
</html>
