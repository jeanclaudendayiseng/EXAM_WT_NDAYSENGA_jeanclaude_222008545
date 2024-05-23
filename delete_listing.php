<?php
// Connection details
include('database_connection.php');

// Check if listing_id is set
if(isset($_REQUEST['listing_id'])) {
    $listing_id = $_REQUEST['listing_id'];

    // Delete dependent records from imagesgallery table
    $stmt = $connection->prepare("DELETE FROM imagesgallery WHERE listing_id=?");
    $stmt->bind_param("i", $listing_id);
    $stmt->execute();
    $stmt->close();

    // Prepare and execute the DELETE statement for the listings table
    $stmt = $connection->prepare("DELETE FROM listings WHERE listing_id=?");
    $stmt->bind_param("i", $listing_id);

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
            <input type="hidden" name="listing_id" value="<?php echo $listing_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br>";
                echo "<a href='listings.php'>OK</a>"; // Assuming listings.php is the page displaying listing records
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
    echo "listing_id is not set.";
}

$connection->close();
?>
