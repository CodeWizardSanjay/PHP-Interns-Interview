<?php
// Start the session
session_start();

// Include the configuration file
require_once 'config.php';

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to check if the email and password match in the database
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    // If a matching record is found, set session variable and redirect to profile page
    if ($result->num_rows == 1) {
        $_SESSION['email'] = $email;
        header("Location: profile.php");
    } else {
        // Display error message if email or password is incorrect
        echo "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <h2>Login</h2>
        <!-- Login form -->
        <form method="post">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <!-- Link to register page -->
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>
