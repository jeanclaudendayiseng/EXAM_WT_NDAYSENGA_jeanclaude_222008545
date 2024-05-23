<?php
    // Connection details
    include('database_connection.php');

    // Check if transaction_id is set
    if(isset($_REQUEST['transaction_id'])) {
        $transaction_id = $_REQUEST['transaction_id'];

        // Prepare and execute the DELETE statement for the transaction table
        $stmt = $connection->prepare("DELETE FROM transaction WHERE transaction_id=?");
        $stmt->bind_param("i", $transaction_id);

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
                <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='transaction.php'>OK</a>"; // Assuming transaction.php is the page displaying transaction records
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
        echo "transaction_id is not set.";
    }

    $connection->close();
?>
