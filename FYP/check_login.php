<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page or display an error message
    header("Location: loginpage.php");
    exit();
}
?>
