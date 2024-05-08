<?php
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

// Retrieve the borrow_id for the current user and non-returned asset
$select_query = "SELECT borrow_id, asset_id FROM inventory_system_borrowing WHERE user_id = ? AND asset_returned = 'No'";
$stmt = $conn->prepare($select_query);


$stmt->bind_param("i", $user_id);
// Execute the statement
$stmt->execute();
$stmt->bind_result($borrow_id, $asset_id);
// Fetch the result
$stmt->fetch();
$stmt->close();

// Check if borrow_id is retrieved
if(isset($borrow_id)) {
    // Update the inventory_system_borrowing table
    $update_query = "UPDATE inventory_system_borrowing SET return_date = CURDATE(), asset_returned = 'Yes' WHERE borrow_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("i", $borrow_id);
    
    // Execute the statement
    if($stmt->execute()) {
        $stmt->close();

        // Update the inventory_system table
        $update_inventory_query = "UPDATE inventory_system SET currently_borrowing = 'No', currently_borrowed_id = NULL WHERE user_id = ?";
        $stmt_inventory = $conn->prepare($update_inventory_query);
        $stmt_inventory->bind_param("i", $user_id);
        
        // Execute the statement
        if($stmt_inventory->execute()) {
            $stmt_inventory->close();
            
            // Update the inventory_system_assets table
            $update_assets_query = "UPDATE inventory_system_assets SET currently_borrowed = 'No', borrowed_by_id = NULL WHERE asset_id = ?";
            $stmt_assets = $conn->prepare($update_assets_query);
            $stmt_assets->bind_param("i", $asset_id);
            
            // Execute the statement
            if($stmt_assets->execute()) {
                echo "Asset returned successfully and inventory updated.";
                $stmt_assets->close();
                
                // Delay before redirecting
                sleep(2);
                
                // Redirect to user_homepage.php
                header("Location: user_homepage.php");
                exit();
            } else {
                echo "Error updating asset inventory: " . $conn->error;
            }
            $stmt_assets->close();
        } else {
            echo "Error updating inventory: " . $conn->error;
        }
    } else {
        echo "Error returning asset: " . $conn->error;
    }
} else {
    echo "No non-returned assets found for the user.";
}
$conn->close();
?>
