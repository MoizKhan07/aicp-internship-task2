<?php 
$taskAdded = false;
    if (isset($_POST['title'])) {
        // Get the input values
        $title = $_POST["title"];
        $desc = $_POST["desc"];
        
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "");
        
        // Check the connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Insert the values into the database
        $sql = "INSERT INTO `task2` . `tasks` (`title`, `description`) VALUES ('$title', '$desc');";
        
        if ($conn->query($sql) == true) {
            $taskAdded = true;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
        // Close the connection
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add Task</title>
</head>
<body>
    <div class="container">
        <h1>To Do</h1>
        <form class="add-task" action="addTask.php" method="post">

            <div class="label-input">
                <label for="title">Task title</label>
                <input id="title" name="title" type="text" placeholder="Enter task here"/>
            </div>
            <div class="label-input">
                <label for="desc">Task Description</label>
                <textarea id="desc" name="desc" type="text" placeholder="Enter description here..." rows="4" cols="50"></textarea>
            </div>
            
            <div class="buttons">
                <button class="btn" type="submit">Add</button>
                <a class="btn" href="index.php">Go Back</a>
            </div>
        </form>
        <?php
            if($taskAdded){
                echo '<h2 class="success task-added">Task added!</h2>';
            }
        ?>
    </div>

    <script src="index.js"></script>
</body>
</html>