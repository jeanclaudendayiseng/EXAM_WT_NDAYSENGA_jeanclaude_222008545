<?php
    // Connection details
    include('database_connection.php');

    // Check if property_id is set
    if(isset($_REQUEST['property_id'])) {
        $property_id = $_REQUEST['property_id'];

        // Prepare and execute the DELETE statement for the properties table
        $stmt = $connection->prepare("DELETE FROM properties WHERE property_id=?");
        $stmt->bind_param("i", $property_id);

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Delete Record</title>
            <script>
                function confirmDelete() {
                    return confirm("Are you sure you want to delete this record?");
                }
            </script>
        </head>
        <body>
            <form method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='properties.php'>OK</a>"; // Assuming properties.php is the page displaying property records
                } else {
                    echo "Error deleting data: " . $stmt->error;
                }
            }
            ?>
        </body>
        </html>
        <?php

        $stmt->close();
    } else {
        echo "property_id is not set.";
    }

    $connection->close();
?>
