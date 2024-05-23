<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOCATIONINFOR</title>
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
    <h1>Location form</h1> <!-- Changed title to Location form -->
    <!-- Form for inserting location data -->
    <form method="post" onsubmit="return confirmInsert();">
      <label for="location_id">Location ID:</label>
      <input type="number" id="location_id" name="location_id" required><br><br>

      <label for="country">Country:</label>
      <input type="text" id="country" name="country" required><br><br>

      <label for="province">Province:</label>
      <input type="text" id="province" name="province" required><br><br>

      <label for="latitude">Latitude:</label>
      <input type="number" id="latitude" name="latitude" step="any" required><br><br>

      <label for="longitude">Longitude:</label>
      <input type="number" id="longitude" name="longitude" step="any" required><br><br>

      <label for="region">Region:</label>
      <input type="text" id="region" name="region"><br><br>

      <label for="neighborhood">Neighborhood:</label>
      <input type="text" id="neighborhood" name="neighborhood"><br><br>

      <label for="street_address">Street Address:</label>
      <input type="text" id="street_address" name="street_address"><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
    // PHP code for inserting location data into the database
    include('database_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      $location_id = $_POST['location_id'];
      $country = $_POST['country'];
      $province = $_POST['province'];
      $latitude = $_POST['latitude'];
      $longitude = $_POST['longitude'];
      $region = $_POST['region'];
      $neighborhood = $_POST['neighborhood'];
      $street_address = $_POST['street_address'];

      $stmt = $connection->prepare("INSERT INTO locations (location_id, country, province, latitude, longitude, region, neighborhood, street_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("isddssss", $location_id, $country, $province, $latitude, $longitude, $region, $neighborhood, $street_address);

      if ($stmt->execute()) {
        echo "<div style='font-size: 24px; color: blue;'>New record has been inserted successfully!</div><br><br><a href='locations.php'>Back to Form</a>";
      } else {
        if ($stmt->errno == 1062) { // Check if error code is for duplicate entry
          echo "<div style='font-size: 24px; color: red;'>The location ID is already used!</div>";
        } else {
          echo "Error inserting data: " . $stmt->error;
        }
      }

      $stmt->close();
    }
    ?>

    <!-- Section for displaying location details from the database -->
    <section>
      <h2>Location Details</h2>
      <table>
        <tr>
          <th>Location ID</th>
          <th>Country</th>
          <th>Province</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Region</th>
          <th>Neighborhood</th>
          <th>Street Address</th>
          <th>Delete</th>
          <th>Update</th>
        </tr>
        <?php
        // PHP code for fetching and displaying location details from the database
        $sql = "SELECT * FROM locations";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
           echo "<tr>
      <td>{$row['location_id']}</td>
      <td>{$row['country']}</td>
      <td>{$row['province']}</td>
      <td>{$row['latitude']}</td>
      <td>{$row['longitude']}</td>
      <td>{$row['region']}</td>
      <td>{$row['neighborhood']}</td>
      <td>{$row['street_address']}</td>
      <td><a style='padding:4px' href='delete_location.php?listing_id={$row['location_id']}'>Delete</a></td> 
      <td><a style='padding:4px' href='update_location.php?listing_id={$row['location_id']}'>Update</a></td> 
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
