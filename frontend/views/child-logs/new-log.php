<?php
require_once __DIR__ . "/../../Template.php";
require_once __DIR__ . "/../../../business-logic/UsersService.php";

Template::header("New Log");

/*url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$child_id = $parts[4];

$usersService = new UsersService();
$user = $UsersService->getUserById($child_id);
*/
?>

<h1>Add a new log for today</h1>


<form action="<?= $this->home ?>/child-logs/<?= $this->user->user_id ?>/new-log" method="post">
    <label>Emotion:</label>
    <?php
        $emotionOptions = ['Happy', 'Excited', 'Loved', 'Bored', 'Sad', 'Sick', 'Hurt', 'Sleepy', 'Angry'];
        foreach ($emotionOptions as $option) {
            echo '<div><input type="checkbox" name="emotion[]" value="' . $option . '"> ' . $option . '</div>';
        }
    ?>

    <label>Social:</label>
    <?php
        $socialOptions = ['Parents', 'Siblings', 'Friends', 'Best friend', 'Teacher', 'Stranger'];
        foreach ($socialOptions as $option) {
            echo '<div><input type="checkbox" name="social[]" value="' . $option . '"> ' . $option . '</div>';
        }
    ?>

    <label>Hobby:</label>
    <?php
        $hobbyOptions = ['Sport', 'Instrument', 'Gaming', 'Horse riding', 'Dancing', 'Swimming', 'Drawing', 'Reading', 'Movie'];
        foreach ($hobbyOptions as $option) {
            echo '<div><input type="checkbox" name="hobby[]" value="' . $option . '"> ' . $option . '</div>';
        }
    ?>

    <label>School:</label>
    <?php
        $schoolOptions = ['P.E.', 'Math', 'Language', 'Homework', 'Presentation', 'Groupwork' ];
        foreach ($schoolOptions as $option) {
            echo '<div><input type="checkbox" name="school[]" value="' . $option . '"> ' . $option . '</div>';
        }
    ?>

    <label>Chore:</label>
    <?php
        $choreOptions = ['Cleaned the room', 'Washed dishes', 'Took out the trash', 'Did laundry', 'Mowed the lawn'];
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

    <input type="hidden" name="child" value="<?= $this->user->user_id ?>"> <br>

    <input type="submit" value="Save" class="btn">
</form>