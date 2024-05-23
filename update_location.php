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

    // Check if location_id is set
    if(isset($_REQUEST['location_id'])) {
        $location_id = $_REQUEST['location_id'];
        
        $stmt = $connection->prepare("SELECT * FROM locations WHERE location_id=?");
        $stmt->bind_param("i", $location_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $country = $row['country'];
            $province = $row['province'];
            $latitude = $row['latitude'];
            $longitude = $row['longitude'];
            $region = $row['region'];
            $neighborhood = $row['neighborhood'];
            $street_address = $row['street_address'];
        } else {
            echo "Location not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Location</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
    <!-- Update Location form -->
    <h2><u>Update Form of Location</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="location_id" value="<?php echo $location_id; ?>">
        
        <label for="country">Country:</label>
        <input type="text" name="country" value="<?php echo $country; ?>">
        <br><br>

        <label for="province">Province:</label>
        <input type="text" name="province" value="<?php echo $province; ?>">
        <br><br>

        <label for="latitude">Latitude:</label>
        <input type="text" name="latitude" value="<?php echo $latitude; ?>">
        <br><br>

        <label for="longitude">Longitude:</label>
        <input type="text" name="longitude" value="<?php echo $longitude; ?>">
        <br><br>

        <label for="region">Region:</label>
        <input type="text" name="region" value="<?php echo $region; ?>">
        <br><br>

        <label for="neighborhood">Neighborhood:</label>
        <input type="text" name="neighborhood" value="<?php echo $neighborhood; ?>">
        <br><br>

        <label for="street_address">Street Address:</label>
        <input type="text" name="street_address" value="<?php echo $street_address; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $location_id = $_POST['location_id'];
    $country = $_POST['country'];
    $province = $_POST['province'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $region = $_POST['region'];
    $neighborhood = $_POST['neighborhood'];
    $street_address = $_POST['street_address'];
    
    // Update the location record in the database
    $stmt = $connection->prepare("UPDATE locations SET country=?, province=?, latitude=?, longitude=?, region=?, neighborhood=?, street_address=? WHERE location_id=?");
    $stmt->bind_param("ssddsssi", $country, $province, $latitude, $longitude, $region, $neighborhood, $street_address, $location_id);
    $stmt->execute();
    
    // Redirect to locations.php or any other page displaying location records
    header('Location: locations.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
