<?php
session_start();

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    include("db.php");
    // Check if the user_id is provided in the URL
    if(isset($_GET['user_id'])) {
        // SQL injection prevention
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

        // Fetch user details from the database
        $sql = "SELECT * FROM inventory_system WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the user exists
        if (mysqli_num_rows($result) > 0) {
            //display details
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
    <title>User Details</title>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="user-details">
        <h2 class="text-heading">User Details</h2>

        <a href="view_users.php" class="back-button">Back</a>
        
        <form action="update_user.php" method="POST">
            <table>
                <tr>
                    <td>User ID:</td>
                    <td><?php echo $row['user_id']; ?></td>
                </tr>
                <tr>
                    <td>User Type:</td>
                    <td><?php echo $row['usertype']; ?></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><?php echo $row['username']; ?></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>Encrypted</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
                <tr>
                    <td>Telephone:</td>
                    <td><?php echo $row['telephone']; ?></td>
                </tr>
                <tr>
                    <td>Account Disabled:</td>
                    <td><?php echo $row['account_disabled']; ?></td>
                </tr>
                <tr>
                    <td>Currently Borrowing Asset:</td>
                    <td><?php echo $row['currently_borrowing']; ?></td>
                </tr>
                <tr>
                    <td>Borrowed Asset ID:</td>
                    <td>
                    <?php $assetId = $row['currently_borrowed_id'];
                        if (!empty($assetId)) {
                            echo '<a href="https://w1816963.users.ecs.westminster.ac.uk/FYP/htmlphp/asset_details.php?asset_id=' . $assetId . '">' . $assetId . '</a>';
                        } else {
                            echo 'N/A';
                        }?>
                    </td>
                </tr>
            </table>
        </form>
        <button id="edit-button" type="button" onclick="editUser()">Edit</button>

    <script>
        function editUser() {
            // Get the user ID
            var userId = <?php echo json_encode($user_id); ?>;

            // Redirect to user_details_edit.php with user_id as a query parameter
            window.location.href = "user_details_edit.php?user_id=" + userId;
        }
    </script>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>
<?php
        } else {
            // User not found
            echo "User not found.";
        }
    } else {
        // User ID not provided in the URL
        echo "User ID not provided.";
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
