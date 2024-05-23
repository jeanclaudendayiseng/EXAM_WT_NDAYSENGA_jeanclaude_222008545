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

    // Check if image_id is set
    if(isset($_REQUEST['image_id'])) {
        $image_id = $_REQUEST['image_id'];
        
        $stmt = $connection->prepare("SELECT * FROM imagesgallery WHERE image_id=?");
        $stmt->bind_param("i", $image_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $listing_id = $row['listing_id'];
            $image_url = $row['image_url'];
        } else {
            echo "Image not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update ImagesGallery</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
    <!-- Update Images Gallery form -->
    <h2><u>Update Form of Images Gallery</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="image_id" value="<?php echo $image_id; ?>">
        
        <label for="listing_id">Listing ID:</label>
        <input type="text" name="listing_id" value="<?php echo $listing_id; ?>">
        <br><br>

        <label for="image_url">Image URL:</label>
        <input type="text" name="image_url" value="<?php echo $image_url; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $image_id = $_POST['image_id'];
    $listing_id = $_POST['listing_id'];
    $image_url = $_POST['image_url'];
    
    // Update the image gallery record in the database
    $stmt = $connection->prepare("UPDATE imagesgallery SET listing_id=?, image_url=? WHERE image_id=?");
    $stmt->bind_param("isi", $listing_id, $image_url, $image_id);
    $stmt->execute();
    
    // Redirect to imagesgallery.php or any other page displaying images gallery records
    header('Location: imagesgallery.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
