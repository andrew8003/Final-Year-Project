<?php
include("db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = strtolower($_POST["username"]);
    $email = strtolower($_POST["email"]);
    $password = $_POST["password"];
    $telephone = $_POST["telephone"];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["errorMsg"] = "Invalid email format.";
    } elseif (!preg_match("/^[0-9]{11}$/", $telephone)) {
        $_SESSION["errorMsg"] = "Invalid phone number format";
    } else {
        // Check if username or email already exists
        $checkUserQuery = "SELECT * FROM w1816963_0.inventory_system WHERE username = '$username' OR email = '$email'";
        $checkUserResult = $conn->query($checkUserQuery);

        if ($checkUserResult->num_rows > 0) {
            $_SESSION["errorMsg"] = "Username or email already in use.";
        } else {
            // Hash the password using password_hash()
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Set default value for currently_borrowing
            $currently_borrowing = "No";

            // SQL query to insert data into the database
            $insertQuery = "INSERT INTO w1816963_0.inventory_system (usertype, username, password, email, telephone, account_disabled, currently_borrowing) 
                            VALUES ('U', '$username', '$hashedPassword', '$email', '$telephone', 0, '$currently_borrowing')";

            // Execute SQL query
            if ($conn->query($insertQuery) === TRUE) {
                // Registration success
                header("Location: registration_success.php");
                exit();
            } else {
                $_SESSION["errorMsg"] = "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        }
    }
}
header("Location: loginpage.php");
exit();
?>
