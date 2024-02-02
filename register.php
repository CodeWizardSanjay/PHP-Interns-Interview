<?php
// Include the configuration file
require_once 'config.php';

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to insert user data into the 'users' table
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to the login page if registration is successful
        header("Location: index.php");
    } else {
        // Display an error message if there is an issue with the SQL query
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom styles for background gradient and container -->
    <style>
        body {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Add transparency to container */
            border-radius: 10px; /* Rounded corners for the container */
            padding: 20px; /* Add some padding for better appearance */
            margin-top: 50px; /* Add margin to center the container vertically */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <!-- Registration form -->
        <form method="post">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Login</a></p>
    </div>
</body>
</html>
