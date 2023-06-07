<?php
require_once __DIR__ . "/../../Template.php";
require_once __DIR__ . "/../../../business-logic/UsersService.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

Template::header("New Task");

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$child_id = $parts[4];

$usersService = new UsersService();
$user = $usersService->getUserById($child_id);

?>

<div class="new-task">
    <h1>New Task for <?= $user->username ?></h1>

    <h3>Status: <input type="text" name="status" placeholder="To-do" readonly style="border: none;"> </h3><br>

    <form action="<?= $this->home ?>/parent-tasks/<?= $user->user_id ?>/new-task" method="post">
        <div class="flex-container">
            <label>
                <h3>School:</h3>
            </label>
            <div class="div">
                <?php
                $schoolOptions = ['P.E.', 'Math', 'Language', 'Homework', 'Presentation', 'Groupwork'];
                foreach ($schoolOptions as $option) {
                    echo '<div class="checkbox"><input type="checkbox" name="school[]" value="' . $option . '"> ' . $option . '</div>';
                }
                ?>
            </div>
        </div>

        <div class="flex-container">
            <label>
                <h3>Chore:</h3>
            </label>
            <div class="div">
                <?php
                $choreOptions = ['Clean the room', 'Wash dishes', 'Take out the trash', 'Do laundry', 'Mow the lawn'];
                foreach ($choreOptions as $option) {
                    echo '<div class="checkbox"><input type="checkbox" name="chore[]" value="' . $option . '"> ' . $option . '</div>';
                }
                ?> 
            </div>
        </div>

        <div class="flex-container">
            <label>
                <h3>Food:</h3>
            </label>
            <div class="div">
                <?php
                $foodOptions = ['Breakfast', 'Lunch', 'Dinner', 'Snacks', 'Dessert'];
                foreach ($foodOptions as $option) {
                    echo '<div class="checkbox"><input type="checkbox" name="food[]" value="' . $option . '"> ' . $option . '</div>';
                }
                ?> 
            </div>
        </div>

        <input type="hidden" name="child" value="<?= $user->user_id ?>">
        <input type="hidden" name="parent" value="<?= $this->user->user_id ?>">
        <br>
        <input type="submit" value="Save" class="btn">
    </form>

</div>
