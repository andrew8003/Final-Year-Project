<?php
include("db.php"); // Include the database connection script
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the registration form
    $username = $_POST["Username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $telephone = $_POST["telephone"]; // Corrected the key to "telephone"

    // Perform data validation here if needed

    // Construct the SQL query to insert data into the database
    $sql = "INSERT INTO w1816963_0.inventory_system (usertype, username, password, email, telephone, account_disabled) VALUES ('U', '$username', '$password', '$email', '$telephone', 0)";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Registration successful, you can redirect the user to a success page or login page
        header("Location: registration_success.php");
        exit();
    } else {
        // Registration failed, display an error message
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection when done
$conn->close();
?>
