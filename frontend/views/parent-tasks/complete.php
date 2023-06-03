<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit");

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$task_id = $parts[3];

$TasksService = new TasksService();
$task = $TasksService->getTaskById($task_id);
?>


<div class="new-task">
    <h1>Edit</h1>

    <?php
    if ($task) {
        $schoolOptions = ['P.E.', 'Math', 'Language', 'Homework', 'Presentation', 'Groupwork'];
        $choreOptions = ['Clean the room', 'Wash dishes', 'Take out the trash', 'Do laundry', 'Mow the lawn'];
        $foodOptions = ['Breakfast', 'Lunch', 'Dinner', 'Snacks', 'Dessert'];
    ?>

        <div class="flex-container">
            <form action="<?= $this->home ?>/parent-tasks/<?= $task_id ?>/complete" method="post">
            <div class="task-list">
                <label>
                    <h3>Check if completed:</h3>
                </label>
                <div class="div">

                <input type="checkbox" name="status" value="1" <?= $task->status == 1 ? 'checked' : '' ?>> <br>

                <?php if (!empty($task->school)) : ?>
                    <label>School:</label>
                    <div class="checkbox"><?= is_array($task->school) ? implode(', ', $task->school) : $task->school ?></div>
                <?php endif; ?>

                <?php if (!empty($task->chore)) : ?>
                    <label>Chore:</label>
                    <div class="checkbox"><?= is_array($task->chore) ? implode(', ', $task->chore) : $task->chore ?></div>
                <?php endif; ?>

                <?php if (!empty($task->food)) : ?>
                    <label>Food:</label>
                    <div class="checkbox"><?= is_array($task->food) ? implode(', ', $task->food) : $task->food ?></div>
                <?php endif; ?>

                <input type="hidden" name="task_id" value="<?= $task->task_id ?>"> <br>
                <input type="submit" value="Save" class="btn">
            </form>
        </div>


    <?php
    } else {
        // Display an error message or handle the case where the task doesn't exist
        echo 'Task not found.';
    }
    ?>

</div>