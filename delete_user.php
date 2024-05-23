<?php
    // Connection details
    include('database_connection.php');

    // Check if user_id is set
    if(isset($_REQUEST['user_id'])) {
        $user_id = $_REQUEST['user_id'];

        // Prepare and execute the DELETE statement for the users table
        $stmt = $connection->prepare("DELETE FROM users WHERE user_id=?");
        $stmt->bind_param("i", $user_id);

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
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='users.php'>OK</a>"; // Assuming users.php is the page displaying user records
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
        echo "user_id is not set.";
    }

    $connection->close();
?>
