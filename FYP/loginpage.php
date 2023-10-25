<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["user_id"])) {
    // Redirect to the homepage or any other authenticated page
    header("Location: homepage.php");
    exit();
}

include("db.php"); // Include the database connection script
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
                            <input type="text" name="username" placeholder="Username / Email" class="login-input" required>
                        </div>
                        <div class="input-container">
                            <input type="password" name="password" placeholder="Password" class="login-input" required>
                        </div>
                        <button type="submit" class="login-button">Login</button>
                    </form>
                    <div class="error-box">
                        <?php
                        // Display error message if authentication failed
                        if (!empty($errorMsg)) {
                            echo "<p class='error-message'><strong style='text-shadow: 2px 2px 4px rgba(0, 0, 0, 1);'>$errorMsg</strong></p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <?php include("footer.php"); ?> 
    </div>
</body>
</html>
