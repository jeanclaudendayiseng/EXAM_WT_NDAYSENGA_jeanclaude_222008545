<?php
// Connection details
$host = "localhost";
$user = "jeannine";
$pass = "222008545";
$database = "real_estate_listing_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
<?php
    // Connection details
    include('database_connection.php');

    // Check if transaction_id is set
    if(isset($_REQUEST['transaction_id'])) {
        $transaction_id = $_REQUEST['transaction_id'];
        
        $stmt = $connection->prepare("SELECT * FROM transaction WHERE transaction_id=?");
        $stmt->bind_param("i", $transaction_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $listing_id = $row['listing_id'];
            $buyer_id = $row['buyer_id'];
            $seller_id = $row['seller_id'];
            $transaction_date = $row['transaction_date'];
            $amount = $row['amount'];
        } else {
            echo "Transaction not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Transaction</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
    <!-- Update Transaction form -->
    <h2><u>Update Form of Transaction</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">
        
        <label for="listing_id">Listing ID:</label>
        <input type="text" name="listing_id" value="<?php echo $listing_id; ?>">
        <br><br>

        <label for="buyer_id">Buyer ID:</label>
        <input type="text" name="buyer_id" value="<?php echo $buyer_id; ?>">
        <br><br>

        <label for="seller_id">Seller ID:</label>
        <input type="text" name="seller_id" value="<?php echo $seller_id; ?>">
        <br><br>

        <label for="transaction_date">Transaction Date:</label>
        <input type="text" name="transaction_date" value="<?php echo $transaction_date; ?>">
        <br><br>

        <label for="amount">Amount:</label>
        <input type="text" name="amount" value="<?php echo $amount; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    </center>
</body>
</html>
   <?php
        include('database_connection.php');

        if(isset($_POST['up'])) {
            // Retrieve updated values from form
            $transaction_id = $_POST['transaction_id'];
            $listing_id = $_POST['listing_id'];
            $buyer_id = $_POST['buyer_id'];
            $seller_id = $_POST['seller_id'];
            $transaction_date = $_POST['transaction_date'];
            $amount = $_POST['amount'];
            
            // Update the transaction record in the database
            $stmt = $connection->prepare("UPDATE transaction SET listing_id=?, buyer_id=?, seller_id=?, transaction_date=?, amount=? WHERE transaction_id=?");
            $stmt->bind_param("iiisdi", $listing_id, $buyer_id, $seller_id, $transaction_date, $amount, $transaction_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "<div style='font-size: 24px; color: blue;'>New record has been updated successfully!</div>";
            } else {
                echo "<div style='font-size: 24px; color: red;'>Failed to update record!</div>";
            }

            // Redirect to transaction.php or any other page displaying transaction records
            // header('Location: transaction.php');
            // exit(); // Ensure that no other content is sent after the header redirection
        }
        ?>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $transaction_id = $_POST['transaction_id'];
    $listing_id = $_POST['listing_id'];
    $buyer_id = $_POST['buyer_id'];
    $seller_id = $_POST['seller_id'];
    $transaction_date = $_POST['transaction_date'];
    $amount = $_POST['amount'];
    
    // Update the transaction record in the database
    $stmt = $connection->prepare("UPDATE transaction SET listing_id=?, buyer_id=?, seller_id=?, transaction_date=?, amount=? WHERE transaction_id=?");
    $stmt->bind_param("iiisdi", $listing_id, $buyer_id, $seller_id, $transaction_date, $amount, $transaction_id);
    $stmt->execute();
    
    // Redirect to transaction.php or any other page displaying transaction records
    header('Location: transaction.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>