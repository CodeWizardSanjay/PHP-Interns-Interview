<?php
// Start the session
session_start();

// Include the configuration file
require_once 'config.php';

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

// Get the user's email from the session
$email = $_SESSION['email'];

// Retrieve user information from the database based on the email
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Update user information if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated name and password from the form
    $name = $_POST['name'];
    $password = $_POST['password'];

    // SQL query to update user information in the database
    $sql = "UPDATE users SET name='$name', password='$password' WHERE email='$email'";
    
    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Update the name in the $row variable for display
        $row['name'] = $name;
        echo "Updated successfully"; // Display a success message
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
    <title>Profile</title>
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
        <h2>Profile</h2>
        <!-- Profile update form -->
        <form method="post">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" value="<?php echo $row['password']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <!-- Logout link -->
        <p><a href="index.php">Logout</a></p>
    </div>
</body>
</html>
