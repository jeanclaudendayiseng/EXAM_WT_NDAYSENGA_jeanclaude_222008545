<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>inquiriesinfo</title>
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
      right: 10px;
    }
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

    <h1>Inquiries Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="inquiry_id">Inquiry ID:</label>
      <input type="number" id="inquiry_id" name="inquiry_id" required><br><br>

      <label for="listing_id">Listing ID:</label>
      <input type="number" id="listing_id" name="listing_id" required><br><br>

      <label for="user_id">User ID:</label>
      <input type="number" id="user_id" name="user_id" required><br><br>

      <label for="inquiry_date">Inquiry Date:</label>
      <input type="date" id="inquiry_date" name="inquiry_date" required><br><br>

      <label for="message">Message:</label>
      <input type="text" id="message" name="message" required><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
    include('database_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      $inquiry_id = $_POST['inquiry_id'];
      $listing_id = $_POST['listing_id'];
      $user_id = $_POST['user_id'];
      $inquiry_date = $_POST['inquiry_date'];
      $message = $_POST['message'];

      $stmt = $connection->prepare("INSERT INTO inquiries (inquiry_id, listing_id, user_id, inquiry_date, message) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("iiiss", $inquiry_id, $listing_id, $user_id, $inquiry_date, $message);

      if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br><a href='inquiries.php'>Back to Form</a>";
      } else {
        echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
    }
    ?>

    <section>
      <h2>Inquiries Detail</h2>
      <table>
        <tr>
          <th>Inquiry ID</th>
          <th>Listing ID</th>
          <th>User ID</th>
          <th>Inquiry Date</th>
          <th>Message</th>
          <th>Delete</th>
          <th>Update</th>
        </tr>
        <?php
        $sql = "SELECT * FROM inquiries";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['inquiry_id']}</td>
              <td>{$row['listing_id']}</td>
              <td>{$row['user_id']}</td>
              <td>{$row['inquiry_date']}</td>
              <td>{$row['message']}</td>
              <td><a style='padding:4px' href='delete_inquiry.php?inquiry_id={$row['inquiry_id']}'>Delete</a></td> 
              <td><a style='padding:4px' href='update_inquiry.php?inquiry_id={$row['inquiry_id']}'>Update</a></td> 
            </tr>";
          }
        } else {
          echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        ?>
      </table>
    </section>

    <footer>
      <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Jean claude NDAYISENGA</h2>
    </footer>

  </body>
</html>
