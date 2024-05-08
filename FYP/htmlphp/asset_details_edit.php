<?php
session_start();

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    include("db.php");

    // Check if the asset_id is provided in the URL
    if(isset($_GET['asset_id'])) {
        // SQL injection prevention
        $asset_id = mysqli_real_escape_string($conn, $_GET['asset_id']);

        // Fetch asset details from the database
        $sql = "SELECT * FROM inventory_system_assets WHERE asset_id = '$asset_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the asset exists
        if (mysqli_num_rows($result) > 0) {
            // display details
            $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="additionaldetails.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="favicon.png">
    <title>Asset Details Edit</title>
    <script>
        function validateForm() {
            var name = document.getElementsByName("asset_name")[0].value;
            var description = document.getElementsByName("asset_description")[0].value;
            var location = document.getElementsByName("asset_location")[0].value;
            var serialNum = document.getElementsByName("asset_serialnum")[0].value;
            var group = document.getElementsByName("asset_group")[0].value;

            if (name.length > 255) {
                alert("Asset Name must be less than or equal to 255 characters.");
                return false;
            }

            if (description.length > 255) {
                alert("Asset Description must be less than or equal to 255 characters.");
                return false;
            }

            if (location.length > 255) {
                alert("Asset Location must be less than or equal to 255 characters.");
                return false;
            }

            if (serialNum.length > 50) {
                alert("Asset Serial Number must be less than or equal to 50 characters.");
                return false;
            }

            if (group.length > 255) {
                alert("Asset Group must be less than or equal to 255 characters.");
                return false;
            }

            return true;
        }

        function confirmDelete() {
        if (confirm("Are you sure you want to delete this asset?")) {
            // If the user confirms, submit the form with an action to delete_asset.php
            document.getElementById("asset-details-form").action = "asset_delete.php";
            document.getElementById("asset-details-form").submit();
        }
    }
    </script>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="asset-details">
        <h2 class="text-heading">Asset Details</h2>
        <a href="view_assets.php" class="back-button">Back</a>
        <form id="asset-details-form" action="update_asset.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="asset_id" value="<?php echo $row['asset_id']; ?>">
            <table>
            <tr>
                <td>Asset ID:</td>
                <td><?php echo $row['asset_id']; ?></td>
            </tr>
            <tr>
                <td>Asset Name:</td>
                <td><input type="text" name="asset_name" value="<?php echo $row['asset_name']; ?>" class="editable-field"></td>
            </tr>
            <tr>
                <td>Asset Description:</td>
                <td><textarea name="asset_description" class="editable-field"><?php echo $row['asset_description']; ?></textarea></td>
            </tr>
            <tr>
                <td>Asset Location:</td>
                <td><input type="text" name="asset_location" value="<?php echo $row['asset_location']; ?>" class="editable-field"></td>
            </tr>
            <tr>
                <td>Asset Serial Number:</td>
                <td><input type="text" name="asset_serialnum" value="<?php echo $row['asset_serialnum']; ?>" class="editable-field"></td>
            </tr>
            <tr>
                <td>Asset Group:</td>
                <td><input type="text" name="asset_group" value="<?php echo $row['asset_group']; ?>" class="editable-field"></td>
            </tr>
            <tr>
                <td>Date Created:</td>
                <td><?php echo $row['date_created']; ?></td>
            </tr>
            <tr>
                <td>Available for Borrowing:</td>
                <td>
                    <input type="radio" name="available_borrowing" value="Yes" <?php if($row['available_borrowing'] === 'Yes') echo 'checked'; ?>> Yes
                    <br></br>
                    <input type="radio" name="available_borrowing" value="No" <?php if($row['available_borrowing'] === 'No') echo 'checked'; ?>> No
                </td>
            </tr>
            <tr>
                <td>Currently Being Borrowed:</td>
                <td><?php echo $row['currently_borrowed']; ?></td>
            </tr>
            <tr>
                <td>Borrowed By UserID:</td>
                <td><?php echo $row['borrowed_by_id']; ?></td>
            </tr>
            </table>
            <button id="save-button">Save</button>
            <button id="delete-button" onclick="confirmDelete()">Delete Asset</button>

            <form id="delete-form" action="delete_asset.php" method="POST">
            <input type="hidden" name="asset_id" value="<?php echo $row['asset_id']; ?>">
        </form>
    </form>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>

<?php
        } else {
            // Asset not found
            echo "Asset not found.";
        }
    } else {
        // Asset ID not provided in the URL
        echo "Asset ID not provided.";
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
