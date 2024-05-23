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

// Check if property_id is set
if(isset($_REQUEST['property_id'])) {
    $property_id = $_REQUEST['property_id'];
    
    $stmt = $connection->prepare("SELECT * FROM properties WHERE property_id=?");
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $address = $row['address'];
        $price = $row['price'];
        $size = $row['size'];
        $bedrooms = $row['bedrooms'];
        $bathrooms = $row['bathrooms'];
        $description = $row['description'];
    } else {
        echo "Property not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Property</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
    <!-- Update Property form -->
    <h2><u>Update Form of Property</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
        
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $address; ?>">
        <br><br>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?php echo $price; ?>">
        <br><br>

        <label for="size">Size:</label>
        <input type="text" name="size" value="<?php echo $size; ?>">
        <br><br>

        <label for="bedrooms">Bedrooms:</label>
        <input type="text" name="bedrooms" value="<?php echo $bedrooms; ?>">
        <br><br>

        <label for="bathrooms">Bathrooms:</label>
        <input type="text" name="bathrooms" value="<?php echo $bathrooms; ?>">
        <br><br>

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo $description; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $property_id = $_POST['property_id'];
    $address = $_POST['address'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $description = $_POST['description'];
    
    // Update the property record in the database
    $stmt = $connection->prepare("UPDATE properties SET address=?, price=?, size=?, bedrooms=?, bathrooms=?, description=? WHERE property_id=?");
    $stmt->bind_param("sisdisi", $address, $price, $size, $bedrooms, $bathrooms, $description, $property_id);
    $stmt->execute();
    
    // Redirect to property.php or any other page displaying property records
    header('Location: properties.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
