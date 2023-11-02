<?php
$dbhost = 'phpmyadmin.ecs.westminster.ac.uk';
$dbuser = 'w1816963';
$dbpass = 'k7DaYAnGPcyV';
$dbname = 'w1816963_0';

// Create a DB connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// If the DB connection fails, display an error message and exit
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

// Select the database
mysqli_select_db($conn, $dbname);

// Count the number of rows in the inventory_system table
$userCountQuery = "SELECT COUNT(*) AS user_count FROM inventory_system";
$userCountResult = mysqli_query($conn, $userCountQuery);
if ($userCountResult) {
    $userCountRow = mysqli_fetch_assoc($userCountResult);
    $userCount = $userCountRow['user_count'];
} else {
    $userCount = 0; // Set a default value in case of an error
}
$assetCountQuery = "SELECT COUNT(*) AS asset_count FROM inventory_system_assets";
$assetCountResult = mysqli_query($conn, $assetCountQuery);
if ($assetCountResult) {
    $assetCountRow = mysqli_fetch_assoc($assetCountResult);
    $assetCount = $assetCountRow['asset_count'];
} else {
    $assetCount = 0; // Set a default value in case of an error
}
$groupCountQuery = "SELECT COUNT(DISTINCT `group`) AS group_count FROM inventory_system_assets";
$groupCountResult = mysqli_query($conn, $groupCountQuery);
if ($groupCountResult) {
    $groupCountRow = mysqli_fetch_assoc($groupCountResult);
    $groupCount = $groupCountRow['group_count'];
} else {
    $groupCount = 0; // Set a default value in case of an error
}

?>
