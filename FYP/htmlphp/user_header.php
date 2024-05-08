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
            <a href="user_homepage.php" class="home-button">Home</a>
        </div>
        <div class="center">
            <h2 class="dashboard-title">
                <?php
                $currentPage = basename($_SERVER['PHP_SELF']);

                if ($currentPage === 'user_homepage.php') {
                    echo "User Homepage";
                } elseif ($currentPage === 'user_currently_borrowing.php') {
                    echo "Currently Borrowing";
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
