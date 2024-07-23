<?php 
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "task2");
    
    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Fetch tasks from the database
    $sql = "SELECT id, title, description FROM tasks";
    $result = $conn->query($sql);
    
    // Close the connection after fetching data
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Task List</title>
</head>
<body>
    <div class="container">
        <h1>To Do</h1>
        <div class="task-list">
            <ul class="list">
                <?php 
                if ($result && $result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<li class='list-item'>";
                        echo "<div>";
                        echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                        echo "</div>";
                        echo " <form style='display:inline;' method='post' action='deleteTask.php'>";
                        echo "<input type='hidden' name='task_id' value='" . $row["id"] . "'>";
                        echo "<button class='dlt-btn' type='submit'>X</button>";
                        echo "</form>";
                        echo "</li>";
                    }
                } else {
                    echo "<li class='list-item'>No tasks found.</li>";
                }
                ?>
            </ul>
        </div>
        <a class="btn" href="index.php">Go Back</a>
    </div>

    <script src="index.js"></script>
</body>
</html>