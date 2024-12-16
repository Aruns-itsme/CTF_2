<?php
// Database connection parameters
$servername = "localhost"; // Database server (usually 'localhost' for a local environment)
$username = "root";    // Your MySQL username (e.g., 'todo_user' that you created earlier)
$password = "root"; // Your MySQL password (use the password you created)
$dbname = "todo_app";       // The name of your database (e.g., 'todo_app')

// Create connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connection successful
?>
