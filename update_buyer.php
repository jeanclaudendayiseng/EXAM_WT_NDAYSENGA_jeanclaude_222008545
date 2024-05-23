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

    // Check if buyer_id is set
    if(isset($_REQUEST['buyer_id'])) {
        $buyer_id = $_REQUEST['buyer_id'];
        
        $stmt = $connection->prepare("SELECT * FROM buyer WHERE buyer_id=?");
        $stmt->bind_param("i", $buyer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $budget = $row['budget'];
            $preferences = $row['preferences'];
        } else {
            echo "Buyer not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Buyer</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
    <!-- Update Buyer form -->
    <h2><u>Update Form of Buyer</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="buyer_id" value="<?php echo $buyer_id; ?>">
        
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" value="<?php echo $user_id; ?>">
        <br><br>

        <label for="budget">Budget:</label>
        <input type="text" name="budget" value="<?php echo $budget; ?>">
        <br><br>

        <label for="preferences">Preferences:</label>
        <input type="text" name="preferences" value="<?php echo $preferences; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $buyer_id = $_POST['buyer_id'];
    $user_id = $_POST['user_id'];
    $budget = $_POST['budget'];
    $preferences = $_POST['preferences'];
    
    // Update the buyer record in the database
    $stmt = $connection->prepare("UPDATE buyer SET user_id=?, budget=?, preferences=? WHERE buyer_id=?");
    $stmt->bind_param("iisi", $user_id, $budget, $preferences, $buyer_id);
    $stmt->execute();
    
    // Redirect to buyer.php or any other page displaying buyer records
    header('Location: buyer.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
