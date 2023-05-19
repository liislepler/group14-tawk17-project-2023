<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit");

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$log_id = $parts[4];

$LogsService = new LogsService();
$log = $LogsService->getLogById($log_id);
?>

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
        <label>Emotion:</label>
        <?php
        foreach ($emotionOptions as $option) {
            $isChecked = in_array($option, $log->emotion) ? 'checked' : '';
            echo '<div><input type="checkbox" name="emotion[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
        }
        ?>

        <label>Social:</label>
        <?php
        foreach ($socialOptions as $option) {
            $isChecked = in_array($option, $log->social) ? 'checked' : '';
            echo '<div><input type="checkbox" name="social[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
        }
        ?>

        <label>Hobby:</label>
        <?php
        foreach ($hobbyOptions as $option) {
            $isChecked = in_array($option, $log->hobby) ? 'checked' : '';
            echo '<div><input type="checkbox" name="hobby[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
        }
        ?>

        <label>School:</label>
        <?php
        foreach ($schoolOptions as $option) {
            $isChecked = in_array($option, $log->school) ? 'checked' : '';
            echo '<div><input type="checkbox" name="school[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
        }
        ?>

        <label>Chore:</label>
        <?php
        foreach ($choreOptions as $option) {
            $isChecked = in_array($option, $log->chore) ? 'checked' : '';
            echo '<div><input type="checkbox" name="chore[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
        }
        ?>

        <label>Food:</label>
        <?php
        foreach ($foodOptions as $option) {
            $isChecked = in_array($option, $log->food) ? 'checked' : '';
            echo '<div><input type="checkbox" name="food[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
        }
        ?>

        <input type="hidden" name="log_id" value="<?= $log->log_id ?>"> <br>
        <input type="hidden" name="child" value="<?= $this->user->user_id ?>"> <br>

        <input type="submit" value="Save" class="btn">

        <form action="<?= $this->home ?>/child-logs/<?= $log_id ?>/delete" method="post">
            <input type="submit" value="Delete" class="btn delete-btn">
        </form>
    </form>
<?php
} else {
    // Display an error message or handle the case where the task doesn't exist
    echo 'Logs not found.';
}
?>