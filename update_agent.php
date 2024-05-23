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

    // Check if agent_id is set
    if(isset($_REQUEST['agent_id'])) {
        $agent_id = $_REQUEST['agent_id'];
        
        $stmt = $connection->prepare("SELECT * FROM agents WHERE agent_id=?");
        $stmt->bind_param("i", $agent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $agent_name = $row['agent_name'];
            $agency_name = $row['agency_name'];
            $email = $row['email'];
            $phone_number = $row['phone_number'];
        } else {
            echo "Agent not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Agent</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
    <!-- Update Agent form -->
    <h2><u>Update Form of Agent</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>">
        
        <label for="agent_name">Agent Name:</label>
        <input type="text" name="agent_name" value="<?php echo $agent_name; ?>">
        <br><br>

        <label for="agency_name">Agency Name:</label>
        <input type="text" name="agency_name" value="<?php echo $agency_name; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $agent_id = $_POST['agent_id'];
    $agent_name = $_POST['agent_name'];
    $agency_name = $_POST['agency_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    
    // Update the agent record in the database
    $stmt = $connection->prepare("UPDATE agents SET agent_name=?, agency_name=?, email=?, phone_number=? WHERE agent_id=?");
    $stmt->bind_param("sssii", $agent_name, $agency_name, $email, $phone_number, $agent_id);
    $stmt->execute();
    
    // Redirect to agents.php or any other page displaying agent records
    header('Location: agents.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
