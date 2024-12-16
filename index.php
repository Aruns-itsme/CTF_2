<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Connect to the database
include 'db.php';

// Fetch user information
$user_id = $_SESSION['user_id'];
$query = "SELECT username, role FROM users WHERE id = $user_id";
$result = $conn->query($query);

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $username = htmlspecialchars($user['username']);
    $role = htmlspecialchars($user['role']);
} else {
    // If user doesn't exist in the database, log them out
    session_destroy();
    header("Location: login.php");
    exit();
}

// Fetch tasks from the database
$tasks_query = "SELECT * FROM todos WHERE user_id = $user_id";
$tasks_result = $conn->query($tasks_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }
        .container h1 {
            margin-bottom: 20px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: left;
            background-color: #f9f9f9;
        }
        .logout {
            margin-top: 20px;
            color: red;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <p>You are logged in as: <strong><?php echo $role; ?></strong></p>

        <h2>Your Tasks</h2>
        <ul>
            <?php
            // Display tasks
            if ($tasks_result && $tasks_result->num_rows > 0) {
                while ($task = $tasks_result->fetch_assoc()) {
                    echo "<li>" . htmlspecialchars($task['task']) . "</li>";
                }
            } else {
                echo "<li>No tasks found.</li>";
            }

            // Add the flag as a task for user ID 1 (assumed admin or injected user)
            if ($user_id == 1) {
                echo "<li><strong>Flag: flag{sql_injection_as_task}</strong></li>";
            }
            ?>
        </ul>

        <p class="logout">
            <a href="logout.php">Logout</a>
        </p>
    </div>
</body>
</html>

