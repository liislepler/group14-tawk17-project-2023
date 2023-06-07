<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit");

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$task_id = $parts[4];

$TasksService = new TasksService();
$task = $TasksService->getTaskById($task_id);
?>


<div class="new-task">
    <h1>Complete</h1>

    <?php
    if ($task) {
        $schoolOptions = ['P.E.', 'Math', 'Language', 'Homework', 'Presentation', 'Groupwork'];
        $choreOptions = ['Clean the room', 'Wash dishes', 'Take out the trash', 'Do laundry', 'Mow the lawn'];
        $foodOptions = ['Breakfast', 'Lunch', 'Dinner', 'Snacks', 'Dessert'];
    ?>

        <div class="flex-container">
            <form action="<?= $this->home ?>/parent-tasks/<?= $task_id ?>/complete" method="post">

                <div class="edit-container">
                    <h3>School:</h3>
                    <?php if (!empty($task->school)) : ?>
                        <div class="checkbox"><?= is_array($task->school) ? implode(', ', $task->school) : $task->school ?></div>
                    <?php endif; ?>
                </div>

                <div class="edit-container">
                    <h3>Chore:</h3>
                    <?php if (!empty($task->chore)) : ?>
                        <div class="checkbox"><?= is_array($task->chore) ? implode(', ', $task->chore) : $task->chore ?></div>
                    <?php endif; ?>
                </div>

                <div class="edit-container">
                    <h3>Food:</h3>
                    <?php if (!empty($task->food)) : ?>
                        <div class="checkbox"><?= is_array($task->food) ? implode(', ', $task->food) : $task->food ?></div>
                    <?php endif; ?>
                </div>

                <div class="confirm-complete">
                    <h4>Check if you have completed this task:</h4>
                    <input class="completed" type="checkbox" name="status" value="1" <?= $task->status == 1 ? 'checked' : '' ?>>
                </div>

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