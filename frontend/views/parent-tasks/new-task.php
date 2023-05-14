<?php
require_once __DIR__ . "/../../Template.php";
require_once __DIR__ . "/../../../business-logic/UsersService.php";

Template::header("New Task");

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$child_id = $parts[4];

$usersService = new UsersService();
$user = $usersService->getUserById($child_id);

?>

<h1>New Task for <?= $user->username ?></h1>


<form action="<?= $this->home ?>/parent-tasks/<?= $user->user_id ?>/new-task" method="post">
    <label>School:</label>
    <?php
        $schoolOptions = ['P.E.', 'Math', 'Language', 'Homework', 'Presentation', 'Groupwork' ];
        foreach ($schoolOptions as $option) {
            echo '<div><input type="checkbox" name="school[]" value="' . $option . '"> ' . $option . '</div>';
        }
    ?>

    <label>Chore:</label>
    <?php
        $choreOptions = ['Clean the room', 'Wash dishes', 'Take out the trash', 'Do laundry', 'Mow the lawn'];
        foreach ($choreOptions as $option) {
            echo '<div><input type="checkbox" name="chore[]" value="' . $option . '"> ' . $option . '</div>';
        }
    ?>

    <label>Food:</label>
    <?php
        $foodOptions = ['Breakfast', 'Lunch', 'Dinner', 'Snacks', 'Dessert'];
        foreach ($foodOptions as $option) {
            echo '<div><input type="checkbox" name="food[]" value="' . $option . '"> ' . $option . '</div>';
        }
    ?>

    Status: <input type="number" name="status" placeholder="To-do" readonly style="border: none;"> <br>

    <input type="hidden" name="child" value="<?= $user->user_id ?>"> <br>

    <input type="submit" value="Save" class="btn">
</form>
