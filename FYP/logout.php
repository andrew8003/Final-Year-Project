<?php
session_start();
session_destroy();
header("Location: loginpage.php"); // Redirect to the login page after logging out
exit();
?>