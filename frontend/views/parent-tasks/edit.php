<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit");

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$task_id = $parts[4];

$TasksService = new TasksService();
$task = $TasksService->getTaskById($task_id);
?>

<h1>Edit</h1>

<?php
if ($task) {
    $schoolOptions = ['P.E.', 'Math', 'Language', 'Homework', 'Presentation', 'Groupwork'];
    $choreOptions = ['Clean the room', 'Wash dishes', 'Take out the trash', 'Do laundry', 'Mow the lawn'];
    $foodOptions = ['Breakfast', 'Lunch', 'Dinner', 'Snacks', 'Dessert'];
    ?>
    <form action="<?= $this->home ?>/parent-tasks/<?= $task_id ?>/complete" method="post">
    <label>Status:</label>
    <input type="checkbox" name="status" value="1" <?= $task->status == 1 ? 'checked' : '' ?>> Completed
    
    <label>School:</label>
    <div><?= is_array($task->school) ? implode(', ', $task->school) : $task->school ?></div>

    <label>Chore:</label>
    <div><?= is_array($task->chore) ? implode(', ', $task->chore) : $task->chore ?></div>

    <label>Food:</label>
    <div><?= is_array($task->food) ? implode(', ', $task->food) : $task->food ?></div>

        <input type="hidden" name="task_id" value="<?= $task->task_id ?>"> <br>

        <input type="submit" value="Save" class="btn">
    </form>
    <?php
} else {
    // Display an error message or handle the case where the task doesn't exist
    echo 'Task not found.';
}
?>