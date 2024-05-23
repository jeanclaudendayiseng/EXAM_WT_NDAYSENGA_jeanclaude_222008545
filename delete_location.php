<?php
// Connection details
include('database_connection.php');

// Check if location_id is set
if(isset($_REQUEST['location_id'])) {
    $location_id = $_REQUEST['location_id'];

    // Prepare and execute the DELETE statement for the locations table
    $stmt = $connection->prepare("DELETE FROM locations WHERE location_id=?");
    $stmt->bind_param("i", $location_id);

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Location</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this location?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="location_id" value="<?php echo $location_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Location deleted successfully.<br><br>";
                echo "<a href='locations.php'>OK</a>"; // Assuming locations.php is the page displaying location records
                exit(); // Exit script after successful deletion
            } else {
                echo "Error deleting data: " . $stmt->error;
            }
        }
        ?>
    </body>
    </html>
    <?php

    $stmt->close();
}

// Close connection
$connection->close();
?>
