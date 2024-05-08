<?php
session_start();

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    include("db.php");

    // Check if the form is submitted and asset_id is provided
    if(isset($_POST['asset_id'])) {
        // SQL injection prevention
        $asset_id = mysqli_real_escape_string($conn, $_POST['asset_id']);
        $asset_name = mysqli_real_escape_string($conn, $_POST['asset_name']);
        $asset_description = mysqli_real_escape_string($conn, $_POST['asset_description']);
        $asset_location = mysqli_real_escape_string($conn, $_POST['asset_location']);
        $asset_serialnum = mysqli_real_escape_string($conn, $_POST['asset_serialnum']);
        $asset_group = mysqli_real_escape_string($conn, $_POST['asset_group']);
        $available_borrowing = mysqli_real_escape_string($conn, $_POST['available_borrowing']);

        // Update the asset details in the database
        $sql = "UPDATE inventory_system_assets SET 
                asset_name = '$asset_name',
                asset_description = '$asset_description',
                asset_location = '$asset_location',
                asset_serialnum = '$asset_serialnum',
                asset_group = '$asset_group',
                available_borrowing = '$available_borrowing'
                WHERE asset_id = '$asset_id'";

        if(mysqli_query($conn, $sql)) {
            // Redirect to the asset details page with success message
            header("Location: asset_details.php?asset_id=$asset_id&update=success");
            exit();
        } else {
            // database error
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        // Form not submitted or asset_id not provided
        echo "Form not submitted or asset ID not provided.";
    }
    mysqli_close($conn);
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
?>
