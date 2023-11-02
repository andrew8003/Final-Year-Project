<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="LoginStylesheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="image/x-icon">
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
                <div class="centered-box" id="login-fields" style="display: block;">
                    <!-- Login form HTML here -->
                    <form method="post" action="process.php"> <!-- Set action to your PHP processing script -->
                        <div class="input-container">
                            <input type="text" name="username" placeholder="Username / Email" class="login-input" required>
                        </div>
                        <div class="input-container">
                            <input type="password" name="password" placeholder="Password" class="login-input" required>
                        </div>
                        <div class="button-container">
                            <button type="submit" class="login-button">Login</button>
                            <button type="button" class="register-button" onclick="toggleRegistration()">Register</button>
                        </div>
                        <div class="error-box">
                            <?php
                            // Display error message if authentication failed
                            if (!empty($errorMsg)) {
                                echo "<p class='error-message'><strong style='text-shadow: 2px 2px 4px rgba(0, 0, 0, 1);'>$errorMsg</strong></p>";
                            }
                            ?>
                        </div>
                    </form>
                </div>

                <!-- Registration Form -->
                <div class="centered-box" id="registration-fields" style="display: none;">
                <form method="post" action="registration_process.php">
                    <!-- Registration form HTML here -->
                    <div class="input-container">
                        <input type="text" name="Username" placeholder="Username" class="login-input" required>
                    </div>
                    <div class="input-container">
                        <input type="text" name="email" placeholder="Email" class="login-input" required>
                    </div>
                    <div class="input-container">
                        <input type="password" name="password" placeholder="Password" class="login-input" required>
                    </div>
                    <div class="input-container">
                        <input type="tel" name="telephone" placeholder="Phone Number" class="login-input" required>
                    </div>
                    <div class="button-container">
                        <button type="submit" class="register-button">Register</button>
                        <button type="button" class="login-button" onclick="toggleRegistration()">Back to Login</button>
                    </div>
                </form>
            </div>
                <!-- End of Registration Form -->
            </div>
        </main>
        <?php include("footer.php"); ?> 
    </div>

    <!-- Include the JavaScript code here after the HTML elements -->
    <script>
function toggleRegistration() {
    var loginFields = document.getElementById("login-fields");
    var registrationFields = document.getElementById("registration-fields");
    var loginHeading = document.querySelector(".login-heading");

    if (loginFields.style.display === "block") {
        loginFields.style.display = "none";
        registrationFields.style.display = "block";
        loginHeading.textContent = "REGISTER";
    } else {
        loginFields.style.display = "block";
        registrationFields.style.display = "none";
        loginHeading.textContent = "LOGIN";
    }
}
    </script>
</body>
</html>
