<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Headerstylesheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="image/x-icon">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="top-bar">
        <div class="left">
            <a href="homepage.php" class="home-button">Home</a>
        </div>
        <div class="center">
            <h2 class="dashboard-title">
                <?php
                // Check the current page URL and set the header text
                $currentPage = basename($_SERVER['PHP_SELF']);

                if ($currentPage === 'homepage.php') {
                    echo "Admin Dashboard";
                } elseif ($currentPage === 'view_users.php') {
                    echo "View and Edit Users";
                } elseif ($currentPage === 'add_assets.php') {
                    echo "Add Assets";
                } elseif ($currentPage === 'asset_map.php') {
                    echo "Asset Map";
                } elseif ($currentPage === 'view_assets.php') {
                    echo "Assets";
                } elseif ($currentPage === 'moredetails.php') {
                    echo "More Details";
                }
                ?>
            </h2>
        </div>
        <div class="right">
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </div>
</body>
</html>
