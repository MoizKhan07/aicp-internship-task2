<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = intval($_POST["task_id"]);

    // Get the task details from the tasks table
    $sql = "SELECT * FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();

    if ($task) {
        // Insert the task into the deleted_tasks table
        $sql = "INSERT INTO `deleted-tasks` (Title, Description) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $task["Title"], $task["Description"]);
        $stmt->execute();

        // Delete the task from the tasks table
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $task_id);
        $stmt->execute();

        echo "Task deleted successfully.";
    } else {
        echo "Task not found.";
    }
    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
header("Location: taskList.php"); // Redirect back to the task list
exit();
?>