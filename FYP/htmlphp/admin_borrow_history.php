<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewdetailspages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="favicon.png">
    <title>Borrow History</title>
</head>
<body>
    <?php

    session_start();

    // Check if the user is authenticated and has correct permissions to view the page
    if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {

        include("header.php");
        include("db.php");

        // Define the default sorting column and order
        $sortColumn = "borrow_time"; // Default sorting column
        $sortOrder = "ASC"; // Default sorting order

        // Check if a sorting parameter is provided in the URL
        if (isset($_GET['sort'])) {
            // SQL injection prevention
            $validColumns = array("borrow_id", "asset_id", "user_id", "borrow_time", "date_borrowed");
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

        // Fetch borrowing data from the database with sorting and filtering
        $sql = "SELECT borrow_id, asset_id, user_id, borrow_time, date_borrowed, asset_returned
                FROM inventory_system_borrowing
                WHERE asset_returned = 'Yes'
                ORDER BY $sortColumn $sortOrder";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<h3 class='text-heading'>History of Borrowed Assets, Click on the Table Row To View More Details</h3>";

            echo "
            <div class='table-controls'>
                <div class='dropdown'>
                    <select id='sortby' class='sort-dropdown'>
                        <option value='borrow_time-ASC'>Sort by Borrow Time Ascending</option>
                        <option value='borrow_time-DESC'>Sort by Borrow Time Descending</option>
                        <option value='date_borrowed-ASC'>Sort by Date Borrowed Ascending</option>
                        <option value='date_borrowed-DESC'>Sort by Date Borrowed Descending</option>
                        <option value='expected_return-ASC'>Sort by Expected Return Date Ascending</option>
                        <option value='expected_return-DESC'>Sort by Expected Return Date Descending</option>
                        <option value='overdue-ASC'>Sort by Overdue Ascending</option>
                        <option value='overdue-DESC'>Sort by Overdue Descending</option>
                    </select>
                    <button onclick='sortTable()' class='sort-button'>Sort</button>
                    </div>
                    </td>
                        </tr>
                    </table>
                </div>";
                echo "<div class='table-controls'>
                <table>
                <td>
                    <div class='search-container'>
                    <h3>Search BorrowId UserID or AssetID</h3>
                    <input type='text' id='searchInput' placeholder='Search...'>
                    <button class='search-button' onclick='searchTable()'>Search</button>
                    </div>
                </td>
                    </tr>
                </table>
            </div>";
            ?>
            <div class="asset-details">
                <a href="admin_currently_borrowed.php" class="back-button">Back</a>
            </div>
            <?php

            echo "
            <div class='user-container'>
                <div class='user-details'>
                    <table border='1' id='borrowTable'>
                        <tr>
                            <th>Borrow ID</th>
                            <th>Asset ID</th>
                            <th>User ID</th>
                            <th>Borrow Time</th>
                            <th>Expected Return Date</th>
                            <th>Overdue</th>
                        </tr>";

                    // Output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        // Calculate the expected return date
                        $expectedReturnDate = date('Y-m-d', strtotime($row['date_borrowed'] . ' + ' . $row['borrow_time'] . ' days'));

                        // Calculate if the asset is overdue
                        $overdue = (strtotime(date('Y-m-d')) > strtotime($expectedReturnDate)) ? 'Yes' : 'No';

                        // Display each borrowing data in a row
                        echo "<tr class='table-row asset-row' data-borrow-id='".$row["borrow_id"]."' id='borrow_" . $row["borrow_id"] . "' onclick='viewAssetDetails(" . $row["borrow_id"] . ")' onmouseover='highlightRow(this)' onmouseout='unhighlightRow(this)'>
                        <td>".($row["borrow_id"] ? $row["borrow_id"] : "empty")."</td>
                        <td>".($row["asset_id"] ? $row["asset_id"] : "empty")."</td>
                        <td>".($row["user_id"] ? $row["user_id"] : "empty")."</td>
                        <td>".$row["borrow_time"]."</td>
                        <td>".$expectedReturnDate."</td>
                        <td>".$overdue."</td>
                    </tr>";
                    }
            echo "</table>";
        } else {
            // Display message when no search results are found
            echo "<h3 class='text-heading'>Currently Borrowed Assets</h3>";
            echo "<div class='user-container'>
                <div class='user-details'>";
                    echo "<p>No currently borrowed assets found.</p>";
            echo "</div>
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
        // Redirect to the same page with the sorting parameters
        window.location.href = 'admin_borrow_history.php?sort=' + selectedColumn + '&order=' + selectedOrder;
    }

    function searchTable() {
        var input, filter, table, tr, td, i, j;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("borrowTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            var display = false;
            td = tr[i].getElementsByTagName("td");
            if (tr[i].getElementsByTagName("th").length > 0) {
                tr[i].style.display = "";
                continue;
            }
            for (j = 0; j < td.length; j++) {
                var cell = td[j];
                if (cell) {
                    var txtValue = cell.textContent || cell.innerText;
                    if (txtValue.toUpperCase().includes(filter)) {
                        display = true;
                        break;
                    }
                }
            }
            if (display) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }

    function viewAssetDetails(borrow_id) {
        window.location.href = 'admin_borrow_history_details.php?borrow_id=' + borrow_id;
    }

    function highlightRow(row) {
        row.style.backgroundColor = '#f0f0f0';
        row.style.cursor = 'pointer';
    }

    function unhighlightRow(row) {
        row.style.backgroundColor = '';
    }

    function returnToPreviousPage() {
        history.back(); // This will take the user back to the previous page
    }
</script>
</body>
</html>