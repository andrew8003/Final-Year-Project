<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewdetailspages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="favicon.png">
    <title>View Assets</title>
</head>
<body>
<?php
session_start();
// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    include("header.php");
    include("db.php");
    
    // Define the default sorting column and order
    $sortColumn = "asset_name"; // sorting column
    $sortOrder = "ASC"; // sorting order
    
    // Check if a sorting parameter is provided in the URL
    if (isset($_GET['sort'])) {
        // Validate the sorting parameter to prevent SQL injection
        $validColumns = array("asset_name", "asset_location", "asset_group", "date_created");
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
    
    // Initialize the search query
    $searchQuery = "";
    
    // Check if a search query is provided
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $search = strtolower($search); // Convert search query to lowercase
        // alow search query to be able to search for partial words, and non case sensitive
        $searchQuery = "WHERE LOWER(asset_name) LIKE '%$search%' OR LOWER(asset_location) LIKE '%$search%' OR LOWER(asset_group) LIKE '%$search%' OR asset_id = '$search' OR asset_serialnum LIKE '%$search%'";
    }

    // Fetch asset data from the database with sorting and search
    $sql = "SELECT asset_id, asset_name, asset_description, asset_location, asset_serialnum, asset_group, date_created 
            FROM inventory_system_assets
            $searchQuery
            ORDER BY $sortColumn $sortOrder";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h3 class='text-heading'>Search For Asset And Click To See More Details And Edit</h3>";
        echo "<div class='table-controls'>
            <table>
                <tr>
                <td>
                <div class='dropdown'>
                    <select id='sortby'>
                        <option value='asset_name-ASC'>Name - Ascending</option>
                        <option value='asset_name-DESC'>Name - Descending</option>
                        <option value='asset_location-ASC'>Location - Ascending</option>
                        <option value='asset_location-DESC'>Location - Descending</option>
                        <option value='asset_group-ASC'>Group - Ascending</option>
                        <option value='asset_group-DESC'>Group - Descending</option>
                        <option value='date_created-ASC'>Date Created - Ascending</option>
                        <option value='date_created-DESC'>Date Created - Descending</option>
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
                    <input type='text' name='search' placeholder='Search assets...'>
                    <button type='submit'>Search</button>
                </form>
            </div>
        </td>
            </tr>

        </table>
    </div>
    <div class='table-controls'>
    <table>
        <tr>
            <td>
                <div class='dropdown'>
                    <select id='itemLimit' onchange='limitRows()'>
                        <option value='100'>100</option>
                        <option value='250'>250</option>
                        <option value='500'>500</option>
                        <option value='1000'>1000</option>
                        <option value='All'>All</option>
                    </select>
                    <label for='itemLimit'>Table Items To Show</label>
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
                        <th>Asset Name</th>
                        <th>Asset Location</th>
                        <th>Asset Group</th>
                        <th>Date Added</th>
                    </tr>";

                // Output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    // Display each user's data in a row
                    echo "<tr id='asset_" . $row["asset_id"] . "' class='asset-row' onclick='viewAssetDetails(" . $row["asset_id"] . ")' onmouseover='highlightRow(this)' onmouseout='unhighlightRow(this)'>
                        <td>".($row["asset_name"] ? $row["asset_name"] : "empty")."</td>
                        <td>".($row["asset_location"] ? $row["asset_location"] : "empty")."</td>
                        <td>".($row["asset_group"] ? $row["asset_group"] : "empty")."</td>
                        <td>".$row["date_created"]."</td>
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
                        <option value='asset_name-ASC'>Name - Ascending</option>
                        <option value='asset_name-DESC'>Name - Descending</option>
                        <option value='asset_location-ASC'>Location - Ascending</option>
                        <option value='asset_location-DESC'>Location - Descending</option>
                        <option value='asset_group-ASC'>Group - Ascending</option>
                        <option value='asset_group-DESC'>Group - Descending</option>
                        <option value='date_created-ASC'>Date Created - Ascending</option>
                        <option value='date_created-DESC'>Date Created - Descending</option>
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
                    <input type='text' name='search' placeholder='Search assets...'>
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
    mysqli_close($conn);}
    else{
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
        window.location.href = 'view_assets.php?sort=' + selectedColumn + '&order=' + selectedOrder;
    }
    function limitRows() {
    var selectBox = document.getElementById("itemLimit");
    var selectedOption = selectBox.options[selectBox.selectedIndex].value;
    var rows = document.querySelectorAll(".asset-row");

    if (selectedOption === 'All') {
        // Show all rows
        rows.forEach(function(row) {
            row.style.display = 'table-row';
        });
    } else {
        // Limit the rows
        var limit = parseInt(selectedOption);
        rows.forEach(function(row, index) {
            if (index < limit) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }}

    function viewAssetDetails(assetId) {
        window.location.href = 'asset_details.php?asset_id=' + assetId;
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
    limitRows();
</script>
</body>
</html>