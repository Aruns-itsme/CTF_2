<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $task = $_POST['task'];

    $stmt = $conn->prepare("INSERT INTO todos (user_id, task) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $task);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
