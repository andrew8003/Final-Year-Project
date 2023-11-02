<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Headerstylesheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="image/x-icon">
    <title>User Dashboard</title>
</head>
<body>
    <div class="top-bar">
        <div class="left">
            <a href="<?php echo ($_SESSION['usertype'] === 'A') ? 'homepage.php' : 'user_homepage.php'; ?>" class="home-link">Home</a>
            <a href="homepage.php">
                <img src="media/homelogo.png" alt="" class="home-logo">
            </a>
        </div>
        <div class="center">
            <h2 class="dashboard-title">
                <?php
                // Check the usertype and set the header text accordingly
                if (isset($_SESSION['usertype'])) {
                    if ($_SESSION['usertype'] === 'A') {
                        echo "Admin Dashboard";
                    } elseif ($_SESSION['usertype'] === 'U') {
                        echo "User Dashboard";
                    } else {
                        // Handle other usertypes here, if needed
                    }
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
