<?php
// Connection details
include('database_connection.php');

// Check if buyer_id is set
if(isset($_REQUEST['buyer_id'])) {
    $buyer_id = $_REQUEST['buyer_id'];

    // Delete dependent records from the transaction table first
    $stmt = $connection->prepare("DELETE FROM `buyer` WHERE buyer_id=?");
    $stmt->bind_param("i", $buyer_id);
    $stmt->execute();
    $stmt->close();

    // Prepare and execute the DELETE statement for the buyer table
    $stmt = $connection->prepare("DELETE FROM buyer WHERE buyer_id=?");
    $stmt->bind_param("i", $buyer_id);

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
        <form method="post" action="delete_buyer.php" onsubmit="return confirmDelete();">
            <input type="hidden" name="buyer_id" value="<?php echo $buyer_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br>";
                echo "<a href='buyer.php'>OK</a>"; // Assuming buyer.php is the page displaying buyer records
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
    echo "buyer_id is not set.";
}

$connection->close();
?>
