<?php
// Connection details
include('database_connection.php');

// Check if image_id is set
if(isset($_REQUEST['image_id'])) {
    $image_id = $_REQUEST['image_id'];

    // Prepare and execute the DELETE statement for the imagesgallery table
    $stmt = $connection->prepare("DELETE FROM imagesgallery WHERE image_id=?");
    $stmt->bind_param("i", $image_id);

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
            <input type="hidden" name="image_id" value="<?php echo $image_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br>";
                echo "<a href='imagesgallery.php'>OK</a>"; // Assuming imagesgallery.php is the page displaying image records
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
    echo "image_id is not set.";
}

$connection->close();
?>
