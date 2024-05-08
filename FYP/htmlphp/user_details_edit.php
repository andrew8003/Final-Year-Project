<?php
// Start the session
session_start();

// Check if the user is authenticated and has correct permissions to view the page
if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'A') {
    include("db.php");

    // Check if the user_id is provided in the URL
    if(isset($_GET['user_id'])) {
        // SQL injection prevention
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

        // Fetch user details from the database
        $sql = "SELECT user_id, usertype, username, email, telephone, account_disabled, currently_borrowing, currently_borrowed_id FROM inventory_system WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the user exists
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
    <title>User Details Edit</title>
    <script>

        function validateForm() {
    var userType = document.getElementsByName("usertype")[0].value;
    var username = document.getElementsByName("username")[0].value;
    var password = document.getElementsByName("password")[0].value;
    var email = document.getElementsByName("email")[0].value;
    var telephone = document.getElementsByName("telephone")[0].value;

  
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var telephoneRegex = /^\d{1,20}$/;
    
    // Validation checks
    if (username.length > 50) {
        alert("Username must be less than 50 characters.");
        return false;
    }
    if (password.length > 255) {
        alert("Password must be less than 255 characters.");
        return false;
    }
    if (!emailRegex.test(email) || email.length > 100) {
        alert("Invalid email format or length.");
        return false;
    }
    if (!telephoneRegex.test(telephone)) {
        alert("Telephone must be a number with maximum 20 characters.");
        return false;
    }

    return true; // Form is valid, submit
    }
  
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this user?")) {
            // If the user confirms, submit the form with an action to delete_user.php
            document.getElementById("user-details-form").action = "delete_user.php";
            document.getElementById("user-details-form").submit();
        }
    }

    </script>
    
</head>
<body>
    <?php include("header.php"); ?>

    <div class="user-details">
        <h2 class="text-heading">User Details</h2>
        <a href="view_users.php" class="back-button">Back</a>
        <form id="user-details-form" action="update_user.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <table>
                <tr>
                    <td>User ID:</td>
                    <td><?php echo $row['user_id']; ?></td>
                </tr>
                <tr>
                <td>User type:</td>
                <td>
                    <input type="radio" name="usertype" value="A" <?php echo $row['usertype'] === 'A' ? 'checked' : ''; ?>> Admin
                    <input type="radio" name="usertype" value="U" <?php echo $row['usertype'] === 'U' ? 'checked' : ''; ?>> User
                </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $row['username']; ?>" class="editable-field" ></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" value="" class="editable-field" ></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?php echo $row['email']; ?>" class="editable-field" ></td>
                </tr>
                <tr>
                    <td>Telephone:</td>
                    <td><input type="text" name="telephone" value="<?php echo $row['telephone']; ?>" class="editable-field" ></td>
                </tr>
                <tr>
                    <td>Account disabled:</td>
                <td>
                    <input type="radio" name="account_disabled" value="0" <?php echo $row['account_disabled'] === '0' ? 'checked' : ''; ?>> Enabled
                    <br></br>
                    <input type="radio" name="account_disabled" value="1" <?php echo $row['account_disabled'] === '1' ? 'checked' : ''; ?>> Disabled
                </td>
                </tr>
                <tr>
                    <td>Currently Borrowing Asset:</td>
                    <td><?php echo $row['currently_borrowing']; ?></td>
                </tr>
                <tr>
                    <td>Borrowed Asset ID:</td>
                    <td><?php echo $row['currently_borrowed_id']; ?></td>
                </tr>
               
            </table>
            <button id="save-button">Save</button>
            <button id="delete-button" onclick="confirmDelete()">Delete User</button>
        </form>
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
