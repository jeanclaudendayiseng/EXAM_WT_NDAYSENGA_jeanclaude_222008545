<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        body {
            background-color: #f0f0f0; /* Set your desired background color */
        }
    </style>
<body style="background-image: url('./images/G.jpg');"> <!-- Corrected placement of body tag -->
    <script>
        function validateForm() {
            // Validate email format
            var email = document.getElementById("email").value;
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Validate password length
            var password = document.getElementById("password").value;
            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            }

            // Ask for confirmation before submitting the form
            var confirmation = confirm("Are you sure you want to submit?");
            if (confirmation) {
                return true; // User confirmed, proceed with form submission
            } else {
                return false; // User canceled, do not submit the form
            }
        }
    </script>
</head>
<body>
    <h2>Registration Form</h2>
    <?php
    // Connection details
    include 'database_connection.php';

    // Start output buffering
    ob_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieving form data and sanitizing inputs
        $fname = mysqli_real_escape_string($connection, $_POST['fname']);
        $lname = mysqli_real_escape_string($connection, $_POST['lname']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Check if the username or email already exists
        $sql_check = "SELECT * FROM user WHERE email='$email' OR username='$username'";
        $result_check = $connection->query($sql_check);

        if ($result_check->num_rows > 0) {
            // Username or email already exists, display an error message
            echo "Username or email already exists. Please choose another one.";
        } else {
            // Proceed with inserting the data into the database
            $sql = "INSERT INTO user (firstname, lastname, email, username, password) 
                    VALUES ('$fname','$lname','$email', '$username', '$password')";

            if ($connection->query($sql) === TRUE) {
                // Redirect to login page after successful registration
                header("Location:login.php");
                exit();
            } else {
                // Display error message if insertion fails
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        }
    }

    // Close the database connection
    $connection->close();

    // Flush output buffer and turn off output buffering
    ob_end_flush();
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required><br><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
