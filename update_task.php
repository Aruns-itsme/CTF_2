<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $task_id = $_POST['task_id'];
    $action = $_POST['action'];

    if ($action == "done") {
        $status = 1;
    } elseif ($action == "undone") {
        $status = 0;
    } else {
        exit("Invalid action.");
    }

    $stmt = $conn->prepare("UPDATE todos SET status = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("iii", $status, $task_id, $user_id);

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
