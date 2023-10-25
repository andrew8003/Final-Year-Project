<?php
include("db.php"); // Include the database connection script

// Initialize an error message variable
$errorMsg = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username or email and password from the submitted form
    $usernameOrEmail = $_POST["username"];
    $password = $_POST["password"];

    // Validate if the input is an email address
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        // If it's a valid email address, use it as an email
        $sql = "SELECT * FROM inventory_system WHERE email = '$usernameOrEmail' AND password = '$password'";
    } else {
        // If it's not a valid email address, treat it as a username
        $sql = "SELECT * FROM inventory_system WHERE username = '$usernameOrEmail' AND password = '$password'";
    }

    // Perform a SQL query to check the username or email and password
    $result = $conn->query($sql);

    // Check if a matching user is found
    if ($result->num_rows > 0) {
        // User authentication successful
        // Redirect to homepage.php after successful login
        header("Location: homepage.php");
        $_SESSION["user_id"] = $user_id;
        exit(); // Make sure to exit to prevent further execution
    } else {
        // User authentication failed
        $errorMsg = "Authentication failed. Invalid username or password.";
    }
}

// Close the database connection when done
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
</head>
<body>
    <div class="video-container">
        <video autoplay muted loop id="video-bg">
            <source src="media/background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="content">
        <header>
        </header>
        <main>
            <div class="centered-container">
                <h2 class="login-heading">LOGIN</h2>
                <div class="centered-box">
                    <form method="post" action="process.php"> <!-- Set action to your PHP processing script -->
                        <div class="input-container">
                            <input type="text" name="username" placeholder="Username or Email" class="login-input" required>
                        </div>
                        <div class="input-container">
                            <input type="password" name="password" placeholder="Password" class="login-input" required>
                        </div>
                        <button type="submit" class="login-button">Login</button>
                        <?php
                        // Display error message if authentication failed
                        if (!empty($errorMsg)) {
                            echo "<p class='error-message'>$errorMsg</p>";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </main>
        <footer>
            <p>Inventory and Stock System, Andrew Hanna</p>
        </footer>
    </div>
</body>
</html>
