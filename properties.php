<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>propertyinfo</title>
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

    <h1>Properties Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="property_id">Property ID:</label>
      <input type="number" id="property_id" name="property_id" required><br><br>

      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required><br><br>

      <label for="price">Price:</label>
      <input type="number" id="price" name="price" required><br><br>

      <label for="size">Size:</label>
      <input type="number" id="size" name="size" required><br><br>

      <label for="bedrooms">Bedrooms:</label>
      <input type="number" id="bedrooms" name="bedrooms" required><br><br>

      <label for="bathrooms">Bathrooms:</label>
      <input type="number" id="bathrooms" name="bathrooms" required><br><br>

      <label for="description">Description:</label>
      <input type="text" id="description" name="description" required><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
    include('database_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      $property_id = $_POST['property_id'];
      $address = $_POST['address'];
      $price = $_POST['price'];
      $size = $_POST['size'];
      $bedrooms = $_POST['bedrooms'];
      $bathrooms = $_POST['bathrooms'];
      $description = $_POST['description'];

      $stmt = $connection->prepare("INSERT INTO properties (property_id, address, price, size, bedrooms, bathrooms, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("isiiiss", $property_id, $address, $price, $size, $bedrooms, $bathrooms, $description);

      if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br><a href='properties.php'>Back to Form</a>";
      } else {
        echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
    }
    ?>

    <section>
      <h2>Properties Detail</h2>
      <table>
        <tr>
          <th>Property ID</th>
          <th>Address</th>
          <th>Price</th>
          <th>Size</th>
          <th>Bedrooms</th>
          <th>Bathrooms</th>
          <th>Description</th>
          <th>Delete</th>
          <th>Update</th>
        </tr>
        <?php
        $sql = "SELECT * FROM properties";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['property_id']}</td>
              <td>{$row['address']}</td>
              <td>{$row['price']}</td>
              <td>{$row['size']}</td>
              <td>{$row['bedrooms']}</td>
              <td>{$row['bathrooms']}</td>
              <td>{$row['description']}</td>
              <td><a style='padding:4px' href='delete_property.php?property_id={$row['property_id']}'>Delete</a></td> 
              <td><a style='padding:4px' href='update_property.php?property_id={$row['property_id']}'>Update</a></td> 
            </tr>";
          }
        } else {
          echo "<tr><td colspan='9'>No data found</td></tr>";
        }
        ?>
      </table>
    </section>

    <footer>
      <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Jean claude NDAYISENGA</h2>
    </footer>

  </body>
</html>
