<?php
session_start();

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    include("db.php");

    // Check if the borrow_id is provided in the URL
    if(isset($_GET['borrow_id'])) {
        // SQL injection prevention
        $borrow_id = mysqli_real_escape_string($conn, $_GET['borrow_id']);

        // Fetch details from the inventory_system_borrowing table
        $borrow_sql = "SELECT * FROM inventory_system_borrowing WHERE borrow_id = '$borrow_id'";
        $borrow_result = mysqli_query($conn, $borrow_sql);

        // Check if the borrowing record exists
        if (mysqli_num_rows($borrow_result) > 0) {
            // Borrowing record found, fetch details
            $borrow_row = mysqli_fetch_assoc($borrow_result);

            // Fetch asset details from the database based on asset_id
            $asset_id = $borrow_row['asset_id'];
            $asset_sql = "SELECT * FROM inventory_system_assets WHERE asset_id = '$asset_id'";
            $asset_result = mysqli_query($conn, $asset_sql);
            $asset_row = mysqli_fetch_assoc($asset_result);

            // Fetch user details from the database based on user_id
            $user_id = $borrow_row['user_id'];
            $user_sql = "SELECT * FROM inventory_system WHERE user_id = '$user_id'";
            $user_result = mysqli_query($conn, $user_sql);
            $user_row = mysqli_fetch_assoc($user_result);

            // Handle form submission to add days
            if(isset($_POST['add_days'])) {
                // Get the selected additional days from the dropdown menu
                $additional_days = intval($_POST['additional_days']);

                // Update borrow_time in the database
                $new_borrow_time = $borrow_row['borrow_time'] + $additional_days;
                $update_sql = "UPDATE inventory_system_borrowing SET borrow_time = '$new_borrow_time' WHERE borrow_id = '$borrow_id'";
                mysqli_query($conn, $update_sql);

                // Redirect to the same page to prevent form resubmission
                header("Location: {$_SERVER['REQUEST_URI']}");
                exit();
            }
        } else {
            // Borrowing record not found
            echo "Borrowing record not found.";
        }
    } else {
        // Borrow ID not provided in the URL
        echo "Borrow ID not provided.";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminborrowdetails.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="icon" href="media/favicon.png" type="favicon.png">
    <title>Borrow History Details</title>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="asset-details">

        <form method="POST">
            <h1 class="text-heading">Asset Details</h1>
            <a href="admin_borrow_history.php" class="back-button">Back</a>
            <table>
                <tr>
                    <td>Asset ID:</td>
                    <td><?php echo $asset_row['asset_id']; ?></td>
                </tr>
                <tr>
                    <td>Asset Name:</td>
                    <td><?php echo $asset_row['asset_name']; ?></td>
                </tr>
                <tr>
                    <td>Asset Description:</td>
                    <td><?php echo $asset_row['asset_description']; ?></td>
                </tr>
                <tr>
                    <td>Asset Location:</td>
                    <td><?php echo $asset_row['asset_location']; ?></td>
                </tr>
                <tr>
                    <td>Asset Serial Number:</td>
                    <td><?php echo $asset_row['asset_serialnum']; ?></td>
                </tr>
                <tr>
                    <td>Asset Group:</td>
                    <td><?php echo $asset_row['asset_group']; ?></td>
                </tr>
                <tr>
                    <td>Date Created:</td>
                    <td><?php echo $asset_row['date_created']; ?></td>
                </tr>
                </td>
            </table>
        </form>
        <form method="POST">
        <h1 class="text-heading">User Details</h1>
        <table>
            <tr>
                <td>User ID:</td>
                <td><?php echo $user_row['user_id']; ?></td>
            </tr>
            <tr>
                <td>User Type:</td>
                <td><?php echo $user_row['usertype']; ?></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><?php echo $user_row['username']; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $user_row['email']; ?></td>
            </tr>
            <tr>
                <td>Telephone:</td>
                <td><?php echo $user_row['telephone']; ?></td>
            </tr>
            <tr>
                <td>Account Disabled:</td>
                <td><?php echo $user_row['account_disabled']; ?></td>
            </tr>
        </table>
        </form>

        <form method="POST" action="admin_force_return.php">
        <h1 class="text-heading">Borrow Details</h1>
        <table>
            <tr>
                <td>Borrow ID:</td>
                <td><?php echo $borrow_row['borrow_id']; ?></td>
            </tr>
            <tr>
                <td>User ID:</td>
                <td><?php echo $borrow_row['user_id']; ?></td>
            </tr>
            <tr>
                <td>Asset ID:</td>
                <td><?php echo $borrow_row['asset_id']; ?></td>
            </tr>
            <tr>
                <td>Borrow Time:</td>
                <td><?php echo $borrow_row['borrow_time']; ?></td>
            </tr>
            <tr>
                <td>Date Borrowed:</td>
                <td><?php echo $borrow_row['date_borrowed']; ?></td>
            </tr>
            <tr>
                <td>Expected Return Date:</td>
                <td><?php echo date('Y-m-d', strtotime($borrow_row['date_borrowed'] . ' + ' . $borrow_row['borrow_time'] . ' days')); ?></td>
            </tr>
            <tr>
                <td>Return Date:</td>
                <td><?php echo $borrow_row['return_date']; ?></td>
            </tr>
            <tr>
                <td>Asset Returned:</td>
                <td><?php echo $borrow_row['asset_returned']; ?></td>
            </tr>
        </table>
        </form>
        


    </div>

    <?php include("footer.php"); ?>
    <script>
        document.getElementById("forceReturnBtn").addEventListener("click", function() {
            // Get data from the form
            var borrowId = <?php echo json_encode($borrow_row['borrow_id']); ?>;
            var assetId = <?php echo json_encode($borrow_row['asset_id']); ?>;

            // Create a form element dynamically
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", "admin_force_return.php");

            // Create hidden input fields for borrow_id and asset_id
            var borrowIdInput = document.createElement("input");
            borrowIdInput.setAttribute("type", "hidden");
            borrowIdInput.setAttribute("name", "borrow_id");
            borrowIdInput.setAttribute("value", borrowId);
            form.appendChild(borrowIdInput);

            var assetIdInput = document.createElement("input");
            assetIdInput.setAttribute("type", "hidden");
            assetIdInput.setAttribute("name", "asset_id");
            assetIdInput.setAttribute("value", assetId);
            form.appendChild(assetIdInput);

            // Append the form to the body and submit it
            document.body.appendChild(form);
            form.submit();
        });
    </script>
</body>
</html>