<?php
include("db.php");
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username or email and password from the submitted form
    $usernameOrEmail = strtolower($_POST["username"]);
    $password = $_POST["password"];

    // Validate if the input is an email address
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        // If it's a valid email address, use it as an email
        $sql = "SELECT * FROM inventory_system WHERE email = '$usernameOrEmail'";
    } else {
        // If it's not a valid email address, treat it as a username
        $sql = "SELECT * FROM inventory_system WHERE username = '$usernameOrEmail'";
    }

    // SQL query to check the username or email
    $result = $conn->query($sql);

    // Check if a matching user is found
    if ($result->num_rows > 0) {
        // User exists, verify the password
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        // Use password_verify to check the entered password against the stored hash
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, proceed with login
            $user_id = $row["user_id"];
            $usertype = $row["usertype"];

            // Set the user ID and user type in the session
            $_SESSION["user_id"] = $user_id;
            $_SESSION["usertype"] = $usertype;

            // Redirect based on user type
            if ($usertype === "A") {
                header("Location: homepage.php"); // Redirect to admin homepage
            } elseif ($usertype === "U") {
                header("Location: user_homepage.php"); // Redirect to user homepage
            } else {
                // error
                $_SESSION["errorMsg"] = "Login Failed, Contact Administrator";
            }

            exit();
        } else {
            // Password is incorrect
            $_SESSION["errorMsg"] = "Invalid password.";
        }
    } else {
        // User does not exist
        $_SESSION["errorMsg"] = "Invalid username or email.";
    }
}
$conn->close();

// Redirect back to the login page
header("Location: loginpage.php");
exit();
?>
