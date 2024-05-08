<?php
session_start();
require_once 'db.php';

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
}else{
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
    exit();
}

// Check if the borrow_id is sent from the previous page
if(isset($_POST['borrow_id'])) {
    // Get the borrow_id from the POST data
    $borrow_id = $_POST['borrow_id'];

    // Retrieve the user_id and asset_id using the borrow_id
    $select_query = "SELECT user_id, asset_id FROM inventory_system_borrowing WHERE borrow_id = ?";
    $stmt = $conn->prepare($select_query);
    $stmt->bind_param("i", $borrow_id);

    // Execute the statement
    $stmt->execute();
    $stmt->bind_result($user_id, $asset_id);

    // Fetch the result
    $stmt->fetch();
    $stmt->close();

    // Check if user_id and asset_id are retrieved
    if(isset($user_id) && isset($asset_id)) {
        // Update the inventory_system_borrowing table
        $update_query = "UPDATE inventory_system_borrowing SET return_date = CURDATE(), asset_returned = 'Yes' WHERE borrow_id = ?";
        
        // Prepare the statement
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("i", $borrow_id);
        
        // Execute the statement
        if($stmt->execute()) {
            $stmt->close();

            // Update the inventory_system table
            $update_inventory_query = "UPDATE inventory_system SET currently_borrowing = 'No', currently_borrowed_id = NULL WHERE user_id = ?";
            
            // Prepare the statement
            $stmt_inventory = $conn->prepare($update_inventory_query);
            $stmt_inventory->bind_param("i", $user_id);
            
            // Execute the statement
            if($stmt_inventory->execute()) {
                $stmt_inventory->close();

                // Update the inventory_system_assets table
                $update_assets_query = "UPDATE inventory_system_assets SET currently_borrowed = 'No', borrowed_by_id = NULL WHERE asset_id = ?";

                // Prepare the statement
                $stmt_assets = $conn->prepare($update_assets_query);
                $stmt_assets->bind_param("i", $asset_id);

                // Execute the statement
                if($stmt_assets->execute()) {
                    echo "Asset returned successfully and inventory updated.";
                    $stmt_assets->close();

                    // Delay before redirecting
                    sleep(2);

                    header("Location: admin_currently_borrowed.php");
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
        echo "No user or asset found with the given borrow ID.";
    }
} else {
    echo "No borrow ID provided.";
}
$conn->close();