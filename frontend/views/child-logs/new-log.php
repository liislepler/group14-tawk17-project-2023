<?php
require_once __DIR__ . "/../../Template.php";
require_once __DIR__ . "/../../../business-logic/UsersService.php";

Template::header("New Log");
?>

<div class="new-task-child">
<h1>Add a new log for today</h1>


<form action="<?= $this->home ?>/child-logs/<?= $this->user->user_id ?>/new-log" method="post">

    <div class="flex-container">
        <div class="task-list">
            <label>
                <h3>Emotion:</h3>
            </label>
            <div class="div">
                <?php
                $emotionOptions = ['Happy', 'Excited', 'Loved', 'Bored', 'Sad', 'Sick', 'Hurt', 'Sleepy', 'Angry'];
                foreach ($emotionOptions as $option) {
                    echo '<div class="checkbox"><input type="checkbox" name="emotion[]" value="' . $option . '"> ' . $option . '</div>';
                }
                ?></div>
        </div>
    </div>


    <div class="flex-container">
        <div class="task-list">
            <label>
                <h3>Social:</h3>
            </label>
            <div class="div">
                <?php
                $socialOptions = ['Parents', 'Siblings', 'Friends', 'Best friend', 'Teacher', 'Stranger'];
                foreach ($socialOptions as $option) {
                    echo '<div class="checkbox"><input type="checkbox" name="social[]" value="' . $option . '"> ' . $option . '</div>';
                }
                ?></div>
        </div>
    </div>


    <div class="flex-container">
        <div class="task-list">
            <label>
                <h3>Hobby:</h3>
            </label>
            <div class="div">
                <?php
                $hobbyOptions = ['Sport', 'Instrument', 'Gaming', 'Horse riding', 'Dancing', 'Swimming', 'Drawing', 'Reading', 'Movie'];
                foreach ($hobbyOptions as $option) {
                    echo '<div class="checkbox"><input type="checkbox" name="hobby[]" value="' . $option . '"> ' . $option . '</div>';
                }
                ?></div>
        </div>
    </div>

    <div class="flex-container">
        <form action="<?= $this->home ?>/parent-tasks/<?= $user->user_id ?>/new-task" method="post">
            <div class="task-list">
                <label>
                    <h3>School:</h3>
                </label>
                <div class="div">
                    <?php
                    $schoolOptions = ['P.E.', 'Math', 'Language', 'Homework', 'Presentation', 'Groupwork'];
                    foreach ($schoolOptions as $option) {
                        echo '<div class="checkbox"><input type="checkbox" name="school[]" value="' . $option . '"> ' . $option . '</div>';
                    }
                    ?></div>
            </div>
    </div>

    <div class="flex-container">
        <div class="task-list">
            <label>
                <h3>Chore:</h3>
            </label>
            <div class="div">
                <?php
                $choreOptions = ['Clean the room', 'Wash dishes', 'Take out the trash', 'Do laundry', 'Mow the lawn'];
                foreach ($choreOptions as $option) {
                    echo '<div class="checkbox"><input type="checkbox" name="chore[]" value="' . $option . '"> ' . $option . '</div>';
                }
                ?></div>
        </div>
    </div>

    <div class="flex-container">
        <div class="task-list">
            <label>
                <h3>Food:</h3>
            </label>
            <div class="div">
                <?php
                $foodOptions = ['Breakfast', 'Lunch', 'Dinner', 'Snacks', 'Dessert'];
                foreach ($foodOptions as $option) {
                    echo '<div class="checkbox"><input type="checkbox" name="food[]" value="' . $option . '"> ' . $option . '</div>';
                }
                ?></div>
        </div>

    </div>

    <input type="hidden" name="child" value="<?= $this->user->user_id ?>"> <br>

    <input type="submit" value="Save" class="btn">
</form>    
</div>