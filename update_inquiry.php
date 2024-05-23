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

    // Check if inquiry_id is set
    if(isset($_REQUEST['inquiry_id'])) {
        $inquiry_id = $_REQUEST['inquiry_id'];
        
        $stmt = $connection->prepare("SELECT * FROM inquiries WHERE inquiry_id=?");
        $stmt->bind_param("i", $inquiry_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $listing_id = $row['listing_id'];
            $user_id = $row['user_id'];
            $inquiry_date = $row['inquiry_date'];
            $message = $row['message'];
        } else {
            echo "Inquiry not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Inquiry</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
    <!-- Update Inquiry form -->
    <h2><u>Update Form of Inquiry</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="inquiry_id" value="<?php echo $inquiry_id; ?>">
        
        <label for="listing_id">Listing ID:</label>
        <input type="text" name="listing_id" value="<?php echo $listing_id; ?>">
        <br><br>

        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" value="<?php echo $user_id; ?>">
        <br><br>

        <label for="inquiry_date">Inquiry Date:</label>
        <input type="text" name="inquiry_date" value="<?php echo $inquiry_date; ?>">
        <br><br>

        <label for="message">Message:</label>
        <input type="text" name="message" value="<?php echo $message; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $inquiry_id = $_POST['inquiry_id'];
    $listing_id = $_POST['listing_id'];
    $user_id = $_POST['user_id'];
    $inquiry_date = $_POST['inquiry_date'];
    $message = $_POST['message'];
    
    // Update the inquiry record in the database
    $stmt = $connection->prepare("UPDATE inquiries SET listing_id=?, user_id=?, inquiry_date=?, message=? WHERE inquiry_id=?");
    $stmt->bind_param("iisss", $listing_id, $user_id, $inquiry_date, $message, $inquiry_id);
    $stmt->execute();
    
    // Redirect to inquiries.php or any other page displaying inquiry records
    header('Location: inquiries.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
