<?php
session_start();

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    include("db.php");

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
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Homepage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="favicon.png">
    <title>Admin Dashboard</title>
</head>
<body>
    
    <?php include("header.php"); ?>
    <section>
    <nav>
        <ul class="menuItems">
            <li><a href='add_assets.php' data-item='AddAssets' class="button-link">Add Assets</a></li>
            <li><a href='view_users.php' data-item='ViewUsers' class="button-link">View Users</a></li>
            <li><a href='view_assets.php' data-item='ViewAssets' class="button-link">View Assets</a></li>
            <li><a href='asset_map.php' data-item='AssetMap' class="button-link">Asset Map</a></li>
            <li><a href='admin_currently_borrowed.php' data-item='Currently Borrowed' class="button-link">Currently Borrowed</a></li>
        </ul>
    </nav>
    </section>


<div class="count-container">
    <div class="count-item">
        <table>
            <tr>
                <td>Users</td>
                <td>Assets</td>
                <td>Groups</td>
            </tr>
            <tr>
                <td><?php echo $userCount; ?></td>
                <td><?php echo $assetCount; ?></td>
                <td><?php echo $groupCount; ?></td>
            </tr>
        </table>
    </div>
</div>


<?php include("footer.php"); ?>
</div>
</body>
</html>
