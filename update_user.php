?>
<?php
// Connection details
$host = "localhost";
$user = "jeannine";
$pass = "222008545";
$database = "real_estate_listing_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
<?php
    // Connection details
    include('database_connection.php');

    // Check if user_id is set
    if(isset($_REQUEST['user_id'])) {
        $user_id = $_REQUEST['user_id'];
        
        $stmt = $connection->prepare("SELECT * FROM users WHERE user_id=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
            $phone_number = $row['phone_number'];
            $role = $row['role'];
        } else {
            echo "User not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
    <!-- Update User form -->
    <h2><u>Update Form of User</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
        <br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $password; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>">
        <br><br>

        <label for="role">Role:</label>
        <input type="text" name="role" value="<?php echo $role; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $role = $_POST['role'];
    
    // Update the user record in the database
    $stmt = $connection->prepare("UPDATE users SET username=?, password=?, email=?, phone_number=?, role=? WHERE user_id=?");
    $stmt->bind_param("sssssi", $username, $password, $email, $phone_number, $role, $user_id);
    $stmt->execute();
    
    // Redirect to users.php or any other page displaying user records
    header('Location: users.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
