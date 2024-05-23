<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>transactioninfo</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* Your existing CSS styles */
    /* ... */
    /* Dropdown menu style */
    .dropdown-contents {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    .dropdown:hover .dropdown-contents {
      display: block;
    }
    .dropdown-contents a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    /* Positioning for LOG OUT */
    .logout {
      position: absolute;
      top: 10px;
      right: 10px;}
    table {
      width: 75%; /* Set table to full width */
      border-collapse: revert; /* Merge borders */
    }

    /* Special Styling for First Column */
    td:first-child {
      background-color: #333333;
      color: #ffffff;
    }

    /* Table Cells */
    td {
      padding: 8px;
      border-bottom: 1px solid #dddddd;
    }

    /* Hover Effect */
    tr:hover {
      background-color: #e9e9e9;
    }

    th, td {
      border: 2px solid black; /* Table borders */
      padding: 10px; /* Padding for readability */
      text-align: left;
    }

    th {
      background-color: orange; /* Header row color */
    }
  </style>
  <!-- JavaScript function for insert confirmation -->
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</head>
<body style="background-color: lightblue;">
  <header>
    <button onclick="window.location.href='logout.php'" style="position: absolute; top: 10px; right: 10px;">Logout</button>
    <ul style="list-style-type: none; padding: 0;">
      <li style="display: inline; margin-right: 10px;">
        <ul style="list-style-type: none; padding: 0;">
          <li style="display: inline; margin-right: 8px;padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;"><a href="./home.html">HOME</a></li>
          <li style="display: inline; margin-right: 10px;padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;"><a href="./about.html">ABOUT</a></li>
          <li style="display: inline; margin-right: 10px;padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;"><a href="./contact.html">CONTACT</a></li>
          <li class="dropdown" style="display: inline;">
            <a href="#" style="padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;"> TABLES </a>
            <div class="dropdown-contents">
              <a href="./users.php">USERS</a>
              <a href="./transaction.php">TRANSACTION</a> 
              <a href="./seller.php">SELLER</a>
              <a href="./properties.php">PROPERTIES</a>
              <a href="./listings.php">LISTINGS</a>
              <a href="./inquiries.php"> INQUIRIES</a>
              <a href="./imagesgallery.php">IMEGESGALLERY</a>
              <a href="./buyer.php">BUYER</a>
              <a href="./agents.php">AGENTS</a>
              <a href="./locations.php">LOCATIONS</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
     <! -- LOG OUT button -->
    <a class="logout"href="logout.php" style="padding: 10px; color: white; background: red; text-decoration: none;">LOG OUT</a>
  </header>

  <body style="background-color: yellowgreen;">
    <h1>Transaction form</h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="transaction_id">Transaction ID:</label>
      <input type="number" id="transaction_id" name="transaction_id" required><br><br>

      <label for="listing_id">Listing ID:</label>
      <input type="number" id="listing_id" name="listing_id" required><br><br>

      <label for="buyer_id">Buyer ID:</label>
      <input type="number" id="buyer_id" name="buyer_id" required><br><br>

      <label for="seller_id">Seller ID:</label>
      <input type="number" id="seller_id" name="seller_id" required><br><br>

      <label for="transaction_date">Transaction Date:</label>
      <input type="date" id="transaction_date" name="transaction_date" required><br><br>

      <label for="amount">Amount:</label>
      <input type="number" id="amount" name="amount" required><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
    include('database_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      $transaction_id = $_POST['transaction_id'];
      $listing_id = $_POST['listing_id'];
      $buyer_id = $_POST['buyer_id'];
      $seller_id = $_POST['seller_id'];
      $transaction_date = $_POST['transaction_date'];
      $amount = $_POST['amount'];

      $stmt = $connection->prepare("INSERT INTO transaction (transaction_id, listing_id, buyer_id, seller_id, transaction_date, amount) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("iiiisd", $transaction_id, $listing_id, $buyer_id, $seller_id, $transaction_date, $amount);

      if ($stmt->execute()) {
        echo "<div style='font-size: 24px; color: blue;'>New record has been inserted successfully!</div><br><br><a href='transaction.php'>Back to Form</a>";
      } else {
        if ($stmt->errno == 1062) { // Check if error code is for duplicate entry
          echo "<div style='font-size: 24px; color: red;'>Your transaction_id is already used!</div>";
        } else {
          echo "Error inserting data: " . $stmt->error;
        }
      }

      $stmt->close();
    }
    ?>

    <section>
      <h2>Transaction Detail</h2>
      <table>
        <tr>
          <th>transaction_id </th>
          <th>listing_id</th>
          <th>buyer_id </th>
          <th>seller_id</th>
          <th>transaction_date</th>
          <th>amount</th>
          <th>Delete</th>
          <th>Update</th>
        </tr>
        <?php
        $sql = "SELECT * FROM transaction";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['transaction_id']}</td>
              <td>{$row['listing_id']}</td>
              <td>{$row['buyer_id']}</td>
              <td>{$row['seller_id']}</td>
              <td>{$row['transaction_date']}</td>
              <td>{$row['amount']}</td>
              <td><a style='padding:4px' href='delete_transaction.php?transaction_id={$row['transaction_id']}'>Delete</a></td> 
              <td><a style='padding:4px' href='update_transaction.php?transaction_id={$row['transaction_id']}'>Update</a></td> 
            </tr>";
          }
        } else {
          echo "<tr><td colspan='8'>No data found</td></tr>";
        }
        ?>
      </table>
    </section>

    <footer>
      <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Jean claude NDAYISENGA</h2>
    </footer>

  </body>
</html>
