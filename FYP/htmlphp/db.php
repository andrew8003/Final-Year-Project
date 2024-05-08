<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'w1816963_0';


$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn, $dbname);

$userCountQuery = "SELECT COUNT(*) AS user_count FROM inventory_system";
$userCountResult = mysqli_query($conn, $userCountQuery);
if ($userCountResult) {
    $userCountRow = mysqli_fetch_assoc($userCountResult);
    $userCount = $userCountRow['user_count'];
} else {
    $userCount = 0;
}
$assetCountQuery = "SELECT COUNT(*) AS asset_count FROM inventory_system_assets";
$assetCountResult = mysqli_query($conn, $assetCountQuery);
if ($assetCountResult) {
    $assetCountRow = mysqli_fetch_assoc($assetCountResult);
    $assetCount = $assetCountRow['asset_count'];
} else {
    $assetCount = 0;
}
$groupCountQuery = "SELECT COUNT(DISTINCT `asset_group`) AS asset_group FROM inventory_system_assets";
$groupCountResult = mysqli_query($conn, $groupCountQuery);
if ($groupCountResult) {
    $groupCountRow = mysqli_fetch_assoc($groupCountResult);
    $groupCount = $groupCountRow['asset_group'];
} else {
    $groupCount = 0;
}

?>
