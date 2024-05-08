<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userhomepage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="image/x-icon">
    <title>User Dashboard</title>
</head>
<body>
    <div class="video-container">
        <div class="white-box"></div>
        <video autoplay muted loop id="video-bg">
            <source src="media/background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <?php
    // Enable error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    session_start();
    require_once 'db.php';

    // Check if the user is authenticated and has correct permissions to view the page
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        echo "<!DOCTYPE html>
        <head>
        </head>
        <body>
            <script>
                setTimeout(function() {
                    window.location.href = 'accessdenied.php'; // Redirect to the login page 
                }, 0);
            </script>
        </body>
        </html>";
        exit;
    }
    require 'user_header.php';
    ?>

    <div class="assets-container">
    <h1>You Are Currently Borrowing :</h1>
    <table>
        <tr>
            <th>Asset Name</th>
            <th>How Long Your Borrowing (DAYS)</th>
            <th>Date Borrowed</th>
            <th>Borrow ID</th>
        </tr>
        <?php
        // Execute SQL query
        $sql = "SELECT a.asset_name, a.asset_description, b.borrow_time, b.date_borrowed, b.borrow_id
                FROM inventory_system_borrowing b
                INNER JOIN inventory_system_assets a ON b.asset_id = a.asset_id
                INNER JOIN inventory_system i ON b.user_id = i.user_id
                WHERE i.user_id = $user_id AND (b.asset_returned = 'No' OR b.asset_returned IS NULL)"; // Filter by user ID and non-returned assets

        $result = $conn->query($sql);

        // Display fetched results
        if ($result) {
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["asset_name"]. "</td>";
                    echo "<td>" . $row["borrow_time"]. "</td>";
                    echo "<td>" . $row["date_borrowed"]. "</td>";
                    echo "<td>" . $row["borrow_id"]. "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No currently borrowed assets for this user.</td></tr>";
            }
        } else {
            // Display error message for debugging
            echo "<tr><td colspan='5'>Error: " . $sql . "<br>" . $conn->error . "</td></tr>";
        }
        ?>
    </table>

<table>
    <tr>
        <th>Return Date</th>
        <th>Days Until Return</th>
   
    </tr>
    <?php
    $sql = "SELECT DATE_ADD(date_borrowed, INTERVAL borrow_time DAY) AS return_date, DATEDIFF(DATE_ADD(date_borrowed, INTERVAL borrow_time DAY), CURDATE()) AS days_until_return
            FROM inventory_system_borrowing b
            INNER JOIN inventory_system_assets a ON b.asset_id = a.asset_id
            INNER JOIN inventory_system i ON b.user_id = i.user_id
            WHERE i.user_id = $user_id AND (b.asset_returned = 'No' OR b.asset_returned IS NULL)";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["return_date"]. "</td>";
            echo "<td>" . $row["days_until_return"]. "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No currently borrowed assets for this user.</td></tr>";
    }
    ?>
</table>

<!-- Return button  -->
<div style="margin-top: 20px;">
<form action="user_asset_return.php" method="post">
    <input type="hidden" name="borrow_id" value="<?php echo $row["borrow_id"]; ?>">
    <button type="submit" class="return-button">Return</button>
</form>
</div>

</div>

    <?php
    require 'footer.php';
    ?>
</body>
</html>
