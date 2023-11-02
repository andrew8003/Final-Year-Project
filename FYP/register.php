<?php
include("db.php"); // Include the database connection script

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Form data validation (add your validation logic here)

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $username = $_POST["new_username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

    // Insert data into the database
    $stmt = $db->prepare("INSERT INTO users (name, email, phone, username, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $username, $password);

    if ($stmt->execute()) {
        // Registration successful
        echo "Registration successful. You can now log in.";
    } else {
        // Registration failed
        echo "Registration failed. Please try again.";
    }
}

?>
