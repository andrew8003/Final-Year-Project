<?php
session_start();
include("db.php");

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    // Check if the user_id is provided in the URL
    if(isset($_POST['user_id'])) {
        // SQL injection prevention
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

        // Delete the user record from the database
        $sql = "DELETE FROM inventory_system WHERE user_id = '$user_id'";
        if (mysqli_query($conn, $sql)) {
            // Deletion successful, redirect to view_users.php
            header("Location: view_users.php");
            exit();
        } else {
            // Error occurred while deleting user
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // User ID not provided in the form
        echo "User ID not provided.";
    }
    mysqli_close($conn);
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
