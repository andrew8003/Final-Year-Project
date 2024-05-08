<?php
session_start();

    include("db.php");

    // Check if the asset_id is provided in the URL
    if(isset($_GET['asset_id'])) {
        $user_id = $_SESSION['user_id'];
        // SQL injection preventions
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
    <title>Asset Details</title>
</head>
<body>
    <div class="video-container">
        <video autoplay muted loop>
            <source src="media/background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <?php include("user_header.php"); ?>


    <div class="assets-details">
        <h2 class="text-heading">Asset Details</h2>

        <a href="user_homepage.php" class="back-button">Back</a>

        <form action="user_borrow_asset_process.php" method="POST">
            <table>
                <tr>
                    <td>Asset ID:</td>
                    <td><?php echo $row['asset_id']; ?></td>
                </tr>
                <tr>
                    <td>Asset Name:</td>
                    <td><?php echo $row['asset_name']; ?></td>
                </tr>
                <tr>
                    <td>Asset Description:</td>
                    <td><?php echo $row['asset_description']; ?></td>
                </tr>
                <tr>
                    <td>Asset Location:</td>
                    <td><?php echo $row['asset_location']; ?></td>
                </tr>
                <tr>
                    <td>Asset Serial Number:</td>
                    <td><?php echo $row['asset_serialnum']; ?></td>
                </tr>
                <tr>
                    <td>Asset Group:</td>
                    <td><?php echo $row['asset_group']; ?></td>
                </tr>
            </table>
            <div class="centered-container">
                <h3>Select How Many Days To Borrow</h3>
                <select name="borrow_time">
                    <?php
                    // Loop to generate options from 1 to 7
                    for ($i = 1; $i <= 7; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="borrow-button">Borrow</button>
                <!-- Hidden input fields to pass user_id and asset_id -->
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <input type="hidden" name="asset_id" value="<?php echo $asset_id; ?>">
            </div>
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
    mysqli_close($conn);

?>
