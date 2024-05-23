<?php
    // Connection details
    include('database_connection.php');

    // Check if seller_id is set
    if(isset($_REQUEST['seller_id'])) {
        $seller_id = $_REQUEST['seller_id'];

        // Prepare and execute the DELETE statement for the seller table
        $stmt = $connection->prepare("DELETE FROM seller WHERE seller_id=?");
        $stmt->bind_param("i", $seller_id);

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
                <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='seller.php'>OK</a>"; // Assuming seller.php is the page displaying seller records
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
        echo "seller_id is not set.";
    }

    $connection->close();
?>
