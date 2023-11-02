<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // User is not authenticated, display the loading spinner and redirect to the login page after a delay
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='Homepage.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap'>
        <link rel='icon' href='media/favicon.png' type='favicon.png'>
        <title>Loading...</title>
    </head>
    <body>
        <script>
            setTimeout(function() {
                window.location.href = 'loginpage.php'; // Redirect to the login page 
            }, 0);
        </script>
    </body>
    </html>";
    exit();
}

// Check if the user has an admin (usertype A)
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    // User is an admin, display the admin homepage content
    include("db.php"); // Include your database connection script

    // Add code to fetch user counts, asset counts, and group counts from the database
    $userCount; // Initialize the count
    $assetCount; // Initialize the count
    $groupCount; // Initialize the count

    // You should retrieve these counts from your database using appropriate SQL queries

    

    // Display the counts under the buttons
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Homepage.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
        <link rel="icon" href="media/favicon.png" type="favicon.png">
        <title>Admin Dashboard</title>
    </head>
    <body>
    <div class="video-container">
        <div class="white-box"></div> <!-- White box goes here -->
        <video autoplay muted loop id="video-bg">
            <source src="media/background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <?php include("header.php"); ?>

    <div class="button-container">
    <a href="view_users.php" style="text-decoration: none;">
        <button class="button-86" role="button">View / Edit Users</button>
    </a>
</div>
    <div class="button-container">
        <button class="button-86" role="button">Add Assets</button>
    </div>
    <div class="button-container">
        <button class="button-86" role="button">View Assets</button>
    </div>
 
    <div class="count-container">
    <div class="count-item">
        <table>
            <tr>
                <td>Users on System </td>
                <td>Amount of Assets </td>
                <td>Amount of Groups </td>
            </tr>
            <tr>
                <td><?php echo $userCount; ?></td>
                <td><?php echo $assetCount; ?></td>
                <td><?php echo $groupCount; ?></td>
            </tr>
        </table>
    </div>
</div>




    </body>
    <?php include("footer.php"); ?> 
    </html>

    <?php
} else {
    // User is not an admin, display an error message or redirect them to a different page
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='Homepage.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap'>
        <link rel='icon' href='media/favicon.png' type='favicon.png'>
        <title>Access Denied</title>
    </head>
    <body>
        <h2>Access Denied, You are not authorized to view this page</h2>
        <h2>Returning to login page</h2>
        <img src='media/loadingspinner.gif' alt='Loading Spinner'>
        <script>
            setTimeout(function() {
                window.location.href = 'loginpage.php'; // Redirect to the login page after a delay
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>
    </body>
    </html>";
    exit();
}
?>
