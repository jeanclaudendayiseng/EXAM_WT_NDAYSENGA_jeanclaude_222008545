<?php
// Connection details
include('database_connection.php');

// Check if agent_id is set
if(isset($_REQUEST['agent_id'])) {
    $agent_id = $_REQUEST['agent_id'];

    // Prepare and execute the DELETE statement for the agents table
    $stmt = $connection->prepare("DELETE FROM agents WHERE agent_id=?");
    $stmt->bind_param("i", $agent_id);

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
            <input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br>";
                echo "<a href='agents.php'>OK</a>"; // Assuming agents.php is the page displaying agent records
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
    echo "agent_id is not set.";
}

$connection->close();
?>
