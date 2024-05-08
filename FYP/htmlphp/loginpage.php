<?php
session_start();
include("db.php");

$errorMsg = "";

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
            // Password is correct, login
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
                $errorMsg = "Error contact Administrator";
            }
            exit();
        } else {
            // Password is incorrect
            $errorMsg = "Invalid password.";
        }
    } else {
        // User does not exist
        $errorMsg = "Invalid username or email.";
    }
}
$conn->close();
?>

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
                    <form method="post" action="process.php">
                    <div class="input-container">
                        <input type="text" name="username" placeholder="Username / Email" class="login-input" required>
                    </div>
                    <div class="input-container">
                        <input type="password" name="password" placeholder="Password" class="login-input" required>
                    </div>
                    <div class="button-container">
                        <button class="button-64" role="button"><span class="text">Login</span></button>
                        <button class="button-64" onclick="toggleRegistration()" role="button"><span class="text">Register</span></button>
                    </div>
                    <div class="error-box">
                        <?php
                        // Display error message if authentication failed
                        if (isset($_SESSION["errorMsg"]) && !empty($_SESSION["errorMsg"])) {
                            echo "<p class='error-message'><strong style='text-shadow: 2px 2px 4px rgba(0, 0, 0, 1);'>{$_SESSION["errorMsg"]}</strong></p>";
                            unset($_SESSION["errorMsg"]);
                        }
                        ?>
                    </div>
                </form>
                </div>

                <!-- Registration Form -->
                <div class="centered-box" id="registration-fields" style="display: none;">
                <form method="post" action="registration_process.php">
                    <div class="input-container">
                        <input type="text" name="username" placeholder="Username" class="login-input" required>
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
                        <button class="button-64" role="button"><span class="text">Register</span></button>
                        <button class="button-64" onclick="toggleRegistration()" role="button"><span class="text">back To Login</span></button>
                    </div>
                </form>
            </div>
                <!-- End of Registration Form -->
            </div>
        </main>
    </div>
<?php include("footer.php"); ?> 

    <script>
function toggleRegistration() {
    var loginFields = document.getElementById("login-fields");
    var registrationFields = document.getElementById("registration-fields");
    var loginHeading = document.querySelector(".login-heading");
    var centeredContainer = document.querySelector(".centered-container");

    if (loginFields.style.display === "block") {
        loginFields.style.display = "none";
        registrationFields.style.display = "block";
        loginHeading.textContent = "REGISTER";
        centeredContainer.style.justifyContent = "center";
        centeredContainer.style.marginTop = "30vh";
    } else {
        loginFields.style.display = "block";
        registrationFields.style.display = "none";
        loginHeading.textContent = "LOGIN";
        centeredContainer.style.justifyContent = "flex-start";
        centeredContainer.style.marginTop = "";
    }
}
    </script>
</body>
</html>
