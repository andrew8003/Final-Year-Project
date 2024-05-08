<?php
session_start();

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    include("db.php"); //database connection script
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
    exit();
}

// check if the data has been posted from the add_asset page
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $asset_name = $_POST['asset_name'];
    $asset_description = $_POST['asset_description'];
    $asset_location = $_POST['asset_location'];
    $asset_serialnum = $_POST['asset_serialnum'];
    $asset_group = $_POST['asset_group'];
    $available_borrowing = $_POST['available_borrowing'];
    $amount_of_devices = isset($_POST['amount_of_devices']) ? intval($_POST['amount_of_devices']) : 1; // Default is 1 if not provided

    // Getting current date 
    $date_created = date('Y-m-d H:i:s');

    // Default value for currently_borrowed
    $currently_borrowed = 'No';

    // SQL to insert data into the database
    $sql = "INSERT INTO inventory_system_assets (asset_id, asset_name, asset_description, asset_location, asset_serialnum, asset_group, date_created, available_borrowing, currently_borrowed)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // execute the statement multiple times based on the amount_of_devices
    for ($i = 0; $i < $amount_of_devices; $i++) {
        // Generate a random 12-digit number for asset ID
        $asset_id = mt_rand(100000000000, 999999999999);

        $stmt->bind_param("sssssssss", $asset_id, $asset_name, $asset_description, $asset_location, $asset_serialnum, $asset_group, $date_created, $available_borrowing, $currently_borrowed); // Change "ssssssss" to match the number of variables
        $stmt->execute();
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Set a session variable to indicate successful addition
    $_SESSION['asset_added'] = true;

    // Redirect back to add_assets page
    header("Location: add_assets.php");
    exit();
} else {
    echo "<script>alert('Asset has been added to the system.');</script>";

    // Reset session variable
    unset($_SESSION['asset_added']);
}
?>
