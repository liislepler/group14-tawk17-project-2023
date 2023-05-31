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
    <h1>Edit task</h1>

    <?php
    if ($task) {
        $schoolOptions = ['P.E.', 'Math', 'Language', 'Homework', 'Presentation', 'Groupwork'];
        $choreOptions = ['Clean the room', 'Wash dishes', 'Take out the trash', 'Do laundry', 'Mow the lawn'];
        $foodOptions = ['Breakfast', 'Lunch', 'Dinner', 'Snacks', 'Dessert'];

        $task->school = explode(',', $task->school);
        $task->chore = explode(',', $task->chore);
        $task->food = explode(',', $task->food);
    ?>

        <div class="flex-container">
            <form action="<?= $this->home ?>/parent-tasks/<?= $task_id ?>/edit" method="post">
                    <label>
                        <h3>School:</h3>
                    </label>
                    <div class="div">
                        <?php
                        foreach ($schoolOptions as $option) {
                            $isChecked = in_array($option, $task->school) ? 'checked' : '';
                            echo '<div class="checkbox"><input type="checkbox" name="school[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
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
                        foreach ($choreOptions as $option) {
                            $isChecked = in_array($option, $task->chore) ? 'checked' : '';
                            echo '<div class="checkbox"><input type="checkbox" name="chore[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
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
                        foreach ($foodOptions as $option) {
                            $isChecked = in_array($option, $task->food) ? 'checked' : '';
                            echo '<div class="checkbox"><input type="checkbox" name="food[]" value="' . $option . '" ' . $isChecked . '> ' . $option . '</div>';
                        }
                        ?>
                    </div>
                </div>

                <input type="hidden" name="task_id" value="<?= $task->task_id ?>"> <br>

                <input type="submit" value="Save" class="btn">
            </form>

            <form action="<?= $this->home ?>/parent-tasks/<?= $task_id ?>/delete" method="post" onsubmit="return confirmDelete()">
                <input type="submit" value="Delete" class="btn delete-btn">
            </form>
        <?php
    } else {
        // Display an error message or handle the case where the task doesn't exist
        echo 'Logs not found.';
    }
        ?>

        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this task?");
            }
        </script>

        </div>