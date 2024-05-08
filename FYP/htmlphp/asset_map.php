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
    }
    ?>

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



    <?php include("footer.php"); ?>
</body>
</html>