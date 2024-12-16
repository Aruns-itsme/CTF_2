<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $task_id = $_POST['task_id'];

    $stmt = $conn->prepare("DELETE FROM todos WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $user_id);

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
