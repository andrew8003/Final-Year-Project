<?php
session_start();

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    include("db.php");

    // Check if the form is submitted and user_id is provided
    if(isset($_POST['user_id'])) {
        // SQL injection prevention
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
        $account_disabled = mysqli_real_escape_string($conn, $_POST['account_disabled']);

        // Check if a new password is provided and hash it
        if(!empty($_POST['password'])) {
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Update the user details with the new hashed password
            $sql = "UPDATE inventory_system SET 
                    usertype = '$usertype',
                    username = '$username',
                    password = '$hashed_password',
                    email = '$email',
                    telephone = '$telephone',
                    account_disabled = '$account_disabled'
                    WHERE user_id = '$user_id'";
        } else {
            // Update the user details without changing the password
            $sql = "UPDATE inventory_system SET 
                    usertype = '$usertype',
                    username = '$username',
                    email = '$email',
                    telephone = '$telephone',
                    account_disabled = '$account_disabled'
                    WHERE user_id = '$user_id'";
        }

        if(mysqli_query($conn, $sql)) {
            // Redirect to the user details page with success message
            header("Location: user_details.php?user_id=$user_id&update=success");
            exit();
        } else {
            // database error
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        // Form not submitted or user_id not provided
        echo "Form not submitted or user ID not provided.";
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
