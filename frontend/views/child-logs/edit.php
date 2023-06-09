<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit");

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$log_id = $parts[4];

$LogsService = new LogsService();
$log = $LogsService->getLogById($log_id);
?>

<div class="new-task-child">
    <h1>Edit log</h1>

    <?php
    if ($log) {
        $emotionOptions = ['Happy', 'Excited', 'Loved', 'Bored', 'Sad', 'Sick', 'Hurt', 'Sleepy', 'Angry'];
        $socialOptions = ['Parents', 'Siblings', 'Friends', 'Best friend', 'Teacher', 'Stranger'];
        $hobbyOptions = ['Sport', 'Instrument', 'Gaming', 'Horse riding', 'Dancing', 'Swimming', 'Drawing', 'Reading', 'Movie'];
        $schoolOptions = ['P.E.', 'Math', 'Language', 'Homework', 'Presentation', 'Groupwork'];
        $choreOptions = ['Cleaned the room', 'Washed dishes', 'Took out the trash', 'Did laundry', 'Mowed the lawn'];
        $foodOptions = ['Breakfast', 'Lunch', 'Dinner', 'Snacks', 'Dessert'];

        $log->emotion = explode(',', $log->emotion);
        $log->social = explode(',', $log->social);
        $log->hobby = explode(',', $log->hobby);
        $log->school = explode(',', $log->school);
        $log->chore = explode(',', $log->chore);
        $log->food = explode(',', $log->food);
    ?>

    <form action="<?= $this->home ?>/child-logs/<?= $log_id ?>/edit" method="post">
        <div class="flex-container-log">
            <label>
                <h3>Emotion:</h3>
            </label>
            <div class="div">
                <?php
                foreach ($emotionOptions as $option) {
                    $isChecked = in_array($option, $log->emotion) ? 'checked' : '';
                    echo '<div class="checkbox"><input type="checkbox" name="emotion[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
                }
                ?>      
            </div>
        </div>

        <div class="flex-container-log">
            <label>
                <h3>Social:</h3>
            </label>
            <div class="div">
                <?php
                foreach ($socialOptions as $option) {
                    $isChecked = in_array($option, $log->social) ? 'checked' : '';
                    echo '<div class="checkbox"><input type="checkbox" name="social[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
                }
                ?>
            </div>
        </div>


        <div class="flex-container-log">
            <label>
                <h3>Hobby:</h3>
            </label>
            <div class="div">
                <?php
                foreach ($hobbyOptions as $option) {
                    $isChecked = in_array($option, $log->hobby) ? 'checked' : '';
                    echo '<div class="checkbox"><input type="checkbox" name="hobby[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
                }
                ?>
            </div>
        </div>

        <div class="flex-container-log">
            <label>
                <h3>School:</h3>
            </label>
            <div class="div">
                <?php
                foreach ($schoolOptions as $option) {
                    $isChecked = in_array($option, $log->school) ? 'checked' : '';
                    echo '<div class="checkbox"><input type="checkbox" name="school[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
                }
                ?>
            </div>
        </div>

        <div class="flex-container-log">
            <label>
                <h3>Chore:</h3>
            </label>
            <div class="div">
                <?php
                foreach ($choreOptions as $option) {
                    $isChecked = in_array($option, $log->chore) ? 'checked' : '';
                    echo '<div class="checkbox"><input type="checkbox" name="chore[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
                }
                ?>
            </div>
        </div>

        <div class="flex-container-log">
            <label>
                <h3>Food:</h3>
            </label>
            <div class="div">
                <?php
                foreach ($foodOptions as $option) {
                    $isChecked = in_array($option, $log->food) ? 'checked' : '';
                    echo '<div class="checkbox"><input type="checkbox" name="food[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
                }
                ?>
            </div>
        </div>

        <input type="hidden" name="log_id" value="<?= $log->log_id ?>"> <br>
        <input type="hidden" name="child" value="<?= $this->user->user_id ?>"> <br>

        <input type="submit" value="Save" class="btn"> 
    </form>

    <form action="<?= $this->home ?>/child-logs/<?= $log_id ?>/delete" method="post" onsubmit="return confirmDelete()">
        <input type="submit" value="Delete" class="btn delete-btn">
    </form>

    <?php
    } else {
        // Display an error message or handle the case where the task doesn't exist
        echo 'Logs not found.';
    }
    ?>
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this log?');
    }
</script>
