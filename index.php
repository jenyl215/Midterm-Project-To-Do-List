<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width = device - width, initial-scale = 1.0">
    <link rel = "stylesheet" href = "style.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>To-Do List</title>
</head>

<body>
    <div class = "main_container">

        <div class = "first_container">
            <div class = "todo_list">
                <h1>To-Do List</h1>
            </div>
        </div>

        <div class = "second_container">
            <div class = "new_task">
                <h2>New Task <i class="fa fa-book" style="font-size:24px"></i></h2>
                <form action = "add_task.php" method = "POST">
                    <input class = "input_task" name = "task_name" type = "text" placeholder = "Enter a new task..." required/>
                    <button class = "add_task" type = "submit">Add Task</button>
                </form>
            </div>

            <div class = "task_lists">
                <h2>Task Lists <i class="fa fa-thumb-tack" style="font-size:24px"></i></h2> 

                <?php
                $stmt = $conn->query("SELECT * FROM tasks WHERE is_completed = 0");
                $tasks = $stmt->fetchAll();
                    foreach ($tasks as $task) {
                ?>

                <div class = "all_tasks">
                    <div>
                        <form action = "complete_task.php" method = "POST">
                            <input type = "hidden" name = "id" value = "<?= $task['id'] ?>">
                            <input type = "checkbox" name = "is_completed" value = "1" onchange = "this.form.submit()" <?= $task['is_completed'] ? 'checked' : '' ?>>
                        </form>
                            <p><?= $task['task_name'] ?></p>
                    </div>

                    <div>
                        <form action = "delete_task.php" method = "POST">
                            <input type = "hidden" name = "id" value = "<?= $task['id'] ?>">
                            <button class = "delete">Delete<i class = "fa fa-trash-o"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <?php
                }
                ?>

                <h2 class = "done">Completed Tasks <i class="fa fa-calendar-check-o" style="font-size:24px"></i></h2>

                <?php
                    $stmt = $conn->query("SELECT * FROM tasks WHERE is_completed = 1");
                    $tasks = $stmt->fetchAll();
                        foreach ($tasks as $task) {
                    ?>

                <div class = "completed_tasks">
                    <p><?= $task['task_name'] ?></p>
                </div>
                <?php
                    }
                    ?>
            </div>
    </div>

</body>

</html>
