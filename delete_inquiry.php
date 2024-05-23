<?php
// Connection details
include('database_connection.php');

// Check if inquiry_id is set
if(isset($_REQUEST['inquiry_id'])) {
    $inquiry_id = $_REQUEST['inquiry_id'];

    // Prepare and execute the DELETE statement for the inquiries table
    $stmt = $connection->prepare("DELETE FROM inquiries WHERE inquiry_id=?");
    $stmt->bind_param("i", $inquiry_id);

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
            <input type="hidden" name="inquiry_id" value="<?php echo $inquiry_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br>";
                echo "<a href='inquiries.php'>OK</a>"; // Assuming inquiries.php is the page displaying inquiry records
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
    echo "inquiry_id is not set.";
}

$connection->close();
?>
