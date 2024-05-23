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

    // Check if seller_id is set
    if(isset($_REQUEST['seller_id'])) {
        $seller_id = $_REQUEST['seller_id'];
        
        $stmt = $connection->prepare("SELECT * FROM seller WHERE seller_id=?");
        $stmt->bind_param("i", $seller_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $property_id = $row['property_id'];
            $listing_id = $row['listing_id'];
        } else {
            echo "Seller not found.";
            exit(); // Stop further execution if seller not found
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Seller</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
    <!-- Update Seller form -->
    <h2><u>Update Form of Seller</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
        
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" value="<?php echo $user_id; ?>">
        <br><br>

        <label for="property_id">Property ID:</label>
        <input type="text" name="property_id" value="<?php echo $property_id; ?>">
        <br><br>

        <label for="listing_id">Listing ID:</label>
        <input type="text" name="listing_id" value="<?php echo $listing_id; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $seller_id = $_POST['seller_id'];
    $user_id = $_POST['user_id'];
    $property_id = $_POST['property_id'];
    $listing_id = $_POST['listing_id'];
    
    // Check if the provided user_id exists in the users table
    $check_stmt = $connection->prepare("SELECT user_id FROM users WHERE user_id=?");
    $check_stmt->bind_param("i", $user_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if($check_result->num_rows == 0) {
        echo "Invalid user ID. Please provide a valid user ID.";
        exit(); // Stop further execution if user ID is invalid
    }
    
    // Update the seller record in the database
    $stmt = $connection->prepare("UPDATE seller SET user_id=?, property_id=?, listing_id=? WHERE seller_id=?");
    $stmt->bind_param("iiii", $user_id, $property_id, $listing_id, $seller_id);
    $stmt->execute();
    
    // Redirect to update_seller.php to stay on the same page
    header('Location: update_seller.php?seller_id=' . $seller_id);
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
