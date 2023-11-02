<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // User is not authenticated, redirect to the login page
    header("Location: loginpage.php"); // Replace with your login page URL
    exit();
}

// Include your database connection file (db.php)
include("db.php");

// Fetch the account_disabled value from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT account_disabled FROM inventory_system WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $account_disabled = $row['account_disabled'];

    if ($account_disabled == 1) {
        // User's account is disabled, display a message and hide content
        $accountDisabled = true;
    } else {
        $accountDisabled = false;
    }
} else {
    // Handle the case where the user's account is not found in the database
    $accountDisabled = false; // Assuming the account is not disabled by default
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Homepage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="image/x-icon">
    <title>Admin Dashboard</title>
</head>
<body>
    <?php include("header.php"); ?>

    <?php if ($accountDisabled) : ?>
        <div class="account-disabled-message">
            Account disabled - Please contact support for assistance.
        </div>
    <?php else : ?>

        <div class="video-container">
    <div class="white-box"></div> <!-- White box goes here -->
        <video autoplay muted loop id="video-bg">
            <source src="media/background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
        <!-- Add your content here -->
    <?php endif; ?>
</body>
<?php include("footer.php"); ?> 
</html>
