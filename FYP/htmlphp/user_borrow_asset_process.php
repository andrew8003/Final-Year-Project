<?php
session_start();
// Check if the user has an admin (usertype A)
// Check if the user ID is set
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
include("db.php");

// Check if the asset_id and days_to_borrow are provided in the POST
if(isset($_POST['asset_id']) && isset($_POST['borrow_time'])) {
    // SQL injection prevention
    $asset_id = mysqli_real_escape_string($conn, $_POST['asset_id']);
    $days_to_borrow = mysqli_real_escape_string($conn, $_POST['borrow_time']);

    // current date
    $date_borrowed = date("Y-m-d");

    // putting the borrowing information into the database
    $sql = "INSERT INTO inventory_system_borrowing (user_id, asset_id, borrow_time, date_borrowed, asset_returned) VALUES ('{$_SESSION['user_id']}', '$asset_id', '$days_to_borrow', '$date_borrowed', 'No')";
    if(mysqli_query($conn, $sql)) {
        $update_assets_sql = "UPDATE inventory_system_assets SET borrowed_by_id='{$_SESSION['user_id']}', currently_borrowed='Yes' WHERE asset_id='$asset_id'";
        if(mysqli_query($conn, $update_assets_sql)) {
            $update_inventory_sql = "UPDATE inventory_system SET currently_borrowing='Yes', currently_borrowed_id='$asset_id' WHERE user_id='{$_SESSION['user_id']}'";
            if(mysqli_query($conn, $update_inventory_sql)) {
                // Redirect user after detail adding success
                header("Location: user_currently_borrowing.php");
                exit();
            } else {
                // Error updating inventory_system table
                echo "Error updating inventory_system table: " . mysqli_error($conn);
            }
        } else {
            // Error updating inventory_system_assets table
            echo "Error updating inventory_system_assets table: " . mysqli_error($conn);
        }
    } else {
        // Error inserting borrowing information
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Asset ID or days to borrow not provided
    echo "Asset ID or days to borrow not provided.";
}
?>
