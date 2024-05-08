<?php
session_start();

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    include("db.php");
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
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_assets.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="favicon.png">
    <title>Add Assets</title>
    <script>
        function validateForm() {
            var description = document.getElementById("asset_description").value;
            if (description.length > 255) {
                alert("Description cannot exceed 255 characters");
                return false; // Prevent submission
            }
            return true; // Allow submission
        }
    </script>
</head>
<body>
<?php include("header.php"); ?>

<div class="asset-form">
    <form action="add_asset_process.php" method="POST" onsubmit="return validateForm()">
        <label for="asset_name">Asset Name</label>
        <input type="text" id="asset_name" name="asset_name" required placeholder="Enter Asset Name"><br><br>

        <label for="asset_description">Asset Description</label>
        <textarea id="asset_description" name="asset_description" required placeholder="Enter Asset Description (255 characters)"></textarea><br><br>

        <label for="asset_location">Asset Location</label>
        <input type="text" id="asset_location" name="asset_location" placeholder="Enter Asset Location (Can Be Blank)"><br><br>

        <label for="asset_serialnum">Asset Serial Number</label>
        <input type="text" id="asset_serialnum" name="asset_serialnum" pattern="[0-9]+" title="Please enter only numbers" placeholder="Enter Asset Serial Number (Can Be Blank)"><br><br>

        <label for="asset_group">Asset Group</label>
        <input type="text" id="asset_group" name="asset_group" placeholder="Enter Group Name (Can Be Blank)"><br><br>

        <label for="available_borrowing">Asset Available for Borrowing?</label><br>
        <label class="radio">
            <input name="available_borrowing" type="radio" value="Yes" checked> 
            <span>Yes</span>
        </label>
        <label class="radio">
            <input name="available_borrowing" type="radio" value="No"> 
            <span>No</span>
            </label><br><br>
        <label for="amount_of_devices">Amount of Devices to Add (Default 1)</label>
        <p>Careful With Large Numbers 10,000 Assets Will Take ~2Min</p>
        <input type="number" id="amount_of_devices" name="amount_of_devices" value="1"><br><br>

        <input type="submit" value="Add Asset">
    </form>
    
</div>

<?php include("footer.php"); ?>
</body>
</html>