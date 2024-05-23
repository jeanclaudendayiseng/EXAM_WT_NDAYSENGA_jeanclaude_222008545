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

    // Check if listing_id is set
    if(isset($_REQUEST['listing_id'])) {
        $listing_id = $_REQUEST['listing_id'];
        
        $stmt = $connection->prepare("SELECT * FROM listings WHERE listing_id=?");
        $stmt->bind_param("i", $listing_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $property_id = $row['property_id'];
            $agent_id = $row['agent_id'];
            $list_date = $row['list_date'];
            $status = $row['status'];
        } else {
            echo "Listing not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Listing</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
    <!-- Update Listing form -->
    <h2><u>Update Form of Listing</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="listing_id" value="<?php echo $listing_id; ?>">
        
        <label for="property_id">Property ID:</label>
        <input type="text" name="property_id" value="<?php echo $property_id; ?>">
        <br><br>

        <label for="agent_id">Agent ID:</label>
        <input type="text" name="agent_id" value="<?php echo $agent_id; ?>">
        <br><br>

        <label for="list_date">List Date:</label>
        <input type="text" name="list_date" value="<?php echo $list_date; ?>">
        <br><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo $status; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $listing_id = $_POST['listing_id'];
    $property_id = $_POST['property_id'];
    $agent_id = $_POST['agent_id'];
    $list_date = $_POST['list_date'];
    $status = $_POST['status'];
    
    // Update the listing record in the database
    $stmt = $connection->prepare("UPDATE listings SET property_id=?, agent_id=?, list_date=?, status=? WHERE listing_id=?");
    $stmt->bind_param("iiisi", $property_id, $agent_id, $list_date, $status, $listing_id);
    $stmt->execute();
    
    // Redirect to listing.php or any other page displaying listing records
    header('Location: listings.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
