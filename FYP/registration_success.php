<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="LoginStylesheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="image/x-icon">
    <style>
        /* CSS for centering the loading spinner */
        .centered-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Center vertically within the viewport */
        }
    </style>
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
                <h2 class="login-heading">Registration Success...</h2>
                <h1 class="login-heading">Redirecting</h1>
                <img src="media/loadingspinner.gif" alt="Loading Spinner">
            </div>
        </main>
        <?php include("footer.php"); ?> 
    </div>

    <script>
        // JavaScript to redirect after a 2-second delay
        setTimeout(function() {
            window.location.href = "loginpage.php"; // Replace with your login page URL
        }, 5000); // 2000 milliseconds = 2 seconds
    </script>
</body>
</html>
