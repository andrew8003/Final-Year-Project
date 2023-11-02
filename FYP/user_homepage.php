<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // User is not authenticated, redirect to the login page
    header("Location: loginpage.php"); // Replace with your login page URL
    exit();
}

// User is authenticated, display the homepage content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Homepage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="image/x-icon">
    <title>Dashboard</title>
</head>
<body>
    <?php include("header.php"); ?>

    <h2>User Homepage</h2>
</body>
<?php include("footer.php"); ?> 
</html>
