<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate listing platform Search</title>
    <style>
        /* Style for the search button */
        .search-button {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<form method="GET" action="">
    <input type="text" name="query" placeholder="Enter your search term">
    <button type="submit" class="search-button">Search</button>
</form>

<?php
// Connection details
$host = "localhost";
$user = "jeannine";
$pass = "222008545";
$database = "real_estate_listing_platform";

// Create connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Define queries for different tables
    $queries = [
        'agents' => "SELECT agent_id FROM agents WHERE agent_id LIKE '%$searchTerm%'",
        'buyer' => "SELECT buyer_id FROM buyer WHERE buyer_id LIKE '%$searchTerm%'",
        'imagesgallery' => "SELECT imagesgallery_id FROM imagesgallery WHERE image_id LIKE '%$searchTerm%'",
        'inquiries' => "SELECT inquirie_id FROM inquiries WHERE inquirie_id LIKE '%$searchTerm%'",
        'listings' => "SELECT listing_id FROM listings WHERE listing_id LIKE '%$searchTerm%'",
        'locations' => "SELECT location_id FROM location WHERE location_id LIKE '%$searchTerm%'",
        'seller' => "SELECT seller_id FROM seller WHERE seller_id LIKE '%$searchTerm%'",
        'transaction' => "SELECT Transaction_id FROM transaction WHERE Transaction_id LIKE '%$searchTerm%'",
        'users' => "SELECT Username FROM Users WHERE Username LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    $foundResults = false;

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
            $foundResults = true;
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // If no results were found in any table
    if (!$foundResults) {
        echo "<p>No results found matching the search term: '$searchTerm'</p>";
    }

    // Close connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
</body>
</html>
