<?php
require_once __DIR__ . "/../Template.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

Template::header("Home");
$user = getUser();

?>

<?php if ($user) : ?>
    <?php
    $parent_id = $this->user->user_id;
    $usersService = new UsersService();
    $children = $usersService->getChildrenForParent($parent_id);
    ?>




    <?php if ($this->user->user_role === "parent") : ?>
        <div class="parent-view">
            <h4>
                <?php 
                $dinosaur_fetcher = date('d.m.y');
                $currentDayOfWeek = date('l');
                echo "Today is " . $currentDayOfWeek . " " . $dinosaur_fetcher;
                ?> 
            </h4>
            <h1><?= $this->user->username ?>'s view </h1>

            <?php if (count($children) > 0) : ?>
                <?php foreach ($children as $child) : ?>
                    <li class="one-child">
                        <div class="logs">
                            <h3><?php echo $child->username; ?>'s logs today</h3>
                            <?php
                            $LogsService = new LogsService();
                            $logs = $LogsService->getLogsForChild($child->user_id);
                            ?>

                            <div class="to-do-list">
                                <?php
                                $TasksService = new TasksService();
                                $tasks = $TasksService->getTasksForChild($child->user_id);
                                ?>

                                <div class="to-do">
                                    <h3>To-do</h3>
                                    <?php foreach ($tasks as $task) : ?>
                                        <?php if ($task->status == "0") : ?>
                                            <div>
                                                <?php if (!empty($task->school)) : ?>
                                                    <h4>School:</h4> <?= $task->school ?><br>
                                                <?php endif; ?>
                                                <?php if (!empty($task->chore)) : ?>
                                                    <h4>Chore:</h4> <?= $task->chore ?><br>
                                                <?php endif; ?>
                                                <?php if (!empty($task->food)) : ?>
                                                    <h4>Food:</h4> <?= $task->food ?><br>
                                                <?php endif; ?>
                                                <a href="<?= $this->home ?>/parent-tasks/<?= $task->task_id ?>/edit" class="navigation">Edit</a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <button><a href="<?= $this->home ?>/parent-tasks/<?= $child->user_id ?>/new-task" class="btn">Add task</a></button>
                                </div>

                                <div class="to-do">
                                    <h3>Done</h3>
                                    <?php foreach ($tasks as $task) : ?>
                                        <?php if ($task->status == "1") : ?>
                                            <div>
                                                <?php if (!empty($task->school)) : ?>
                                                    <h4>School:</h4> <?= $task->school ?><br>
                                                <?php endif; ?>
                                                <?php if (!empty($task->chore)) : ?>
                                                    <h4>Chore:</h4> <?= $task->chore ?><br>
                                                <?php endif; ?>
                                                <?php if (!empty($task->food)) : ?>
                                                    <h4>Food:</h4> <?= $task->food ?><br>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>


                            </div>

                            <?php foreach ($logs as $log) : ?>
                                <div class="logged-tasks">
                                    <h4>Logged: INSERT API FOR TIME</h4><br>
                                    <div>
                                    <?php if (!empty($log->emotion)) : ?>
                                        <h4> Emotion: </h4><?= $log->emotion ?><br>
                                    <?php endif; ?>
                                    <?php if (!empty($log->social)) : ?>
                                        <h4> Social: </h4><?= $log->social ?><br>
                                    <?php endif; ?>
                                    <?php if (!empty($log->hobby)) : ?>
                                        <h4> Hobby: </h4><?= $log->hobby ?><br>
                                    <?php endif; ?>
                                    <?php if (!empty($log->school)) : ?>
                                        <h4> School: </h4><?= $log->school ?><br>
                                    <?php endif; ?>
                                    <?php if (!empty($log->chore)) : ?>
                                        <h4> Chore: </h4><?= $log->chore ?><br>
                                    <?php endif; ?>
                                    <?php if (!empty($log->food)) : ?>
                                        <h4> Food: </h4><?= $log->food ?><br>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No children found for the parent</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>



    <?php if ($this->user->user_role === "child") : ?>
        <div class="child-view">
        <h4>
            <?php 
            $currentDateTime = date('d.m.y');
            $currentDayOfWeek = date('l');
            echo "Today is " . $currentDayOfWeek . " " . $currentDateTime;
            ?> 
        </h4>
        <h1><?= $this->user->username ?>'s view </h1>
            <div class="to-do-list-child">
                <?php
                $TasksService = new TasksService();
                $tasks = $TasksService->getTasksForChild($this->user->user_id);
                ?>
                <div>
                    <h3>To-do</h3>
                    <?php foreach ($tasks as $task) : ?>
                        <?php if ($task->status == "0") : ?>
                            <div class="to-do-child">
                                <?php if (!empty($task->school)) : ?>
                                    <h4>School: </h4><?= $task->school ?><br>
                                <?php endif; ?>
                                <?php if (!empty($task->chore)) : ?>
                                    <h4>Chore: </h4><?= $task->chore ?><br>
                                <?php endif; ?>
                                <?php if (!empty($task->food)) : ?>
                                    <h4>Food: </h4><?= $task->food ?><br>
                                <?php endif; ?>
                            </div>
                            <button><a href="<?= $this->home ?>/parent-tasks/<?= $task->task_id ?>/complete" class="btn">Complete</a></button>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>


                <div class="done">
                    <h3>Done</h3>
                    <?php foreach ($tasks as $task) : ?>
                        <?php if ($task->status == "1") : ?>
                            <div>
                                <?php if (!empty($task->school)) : ?>
                                    <h4>School: </h4><?= $task->school ?><br>
                                <?php endif; ?>
                                <?php if (!empty($task->chore)) : ?>
                                    <h4>Chore: </h4><?= $task->chore ?><br>
                                <?php endif; ?>
                                <?php if (!empty($task->food)) : ?>
                                    <h4>Food: </h4><?= $task->food ?><br>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                </div>

            <div class="logs">
                <h3>Today's logs</h3>
                <?php
                $LogsService = new LogsService();
                $logs = $LogsService->getLogsForChild($this->user->user_id);
                ?>
                <?php foreach ($logs as $log) : ?>
                    <div class="to-do-list-child">
                        <?php if (!empty($log->emotion)) : ?>
                            <h4>Emotion: </h4><?= $log->emotion ?><br>
                        <?php endif; ?>
                        <?php if (!empty($log->social)) : ?>
                            <h4>Social: </h4><?= $log->social ?><br>
                        <?php endif; ?>
                        <?php if (!empty($log->hobby)) : ?>
                            <h4>Hobby: </h4><?= $log->hobby ?><br>
                        <?php endif; ?>
                        <?php if (!empty($log->school)) : ?>
                            <h4>School: </h4><?= $log->school ?><br>
                        <?php endif; ?>
                        <?php if (!empty($log->chore)) : ?>
                            <h4>Chore: </h4><?= $log->chore ?><br>
                        <?php endif; ?>
                        <?php if (!empty($log->food)) : ?>
                            <h4>Food: </h4><?= $log->food ?><br>
                        <?php endif; ?>
                        <a href="<?= $this->home ?>/child-logs/<?= $log->log_id ?>/edit" class="navigation">Edit</a>

                <?php endforeach; ?>
                <button><a href="<?= $this->home ?>/child-logs/<?= $this->user->user_id ?>/new-log" class="btn">New log</a></button>
            </div>

        </div>
    <?php endif; ?>


<?php else : ?>

        <div class="home-page">
            <div class="home-page-text">
                <h1>Welcome to Trackersaurus</h1>

                <h2>
                    This is Trackersaurus!
                    A tracking application in which parents can track their childrens everyday doings from activities, chores, hobbies, moods, habits, etc.
                    Every day the child is prompted to record their day with fun and interactive designs by adding different activities and descriptions of their day.
                </h2>

                <h2>
                    The child can see their recorded activities in the calendar which they can update and delete at any time.
                    The parent can track their children's activities to get a better insight into their activities, chores, hobbies, moods, habits, etc. in real-time.
                </h2>

                <h2>
                    The children and parents can make separate accounts but each parent is connected with their childs account.
                </h2>

                <br>
                <a href="<?= $this->home ?>/auth/create-account" class="btn">Create Account</a>
                <a href="<?= $this->home ?>/auth/log-in" class="btn">Log in</a>

            </div>

        </div>
    </div>


<?php endif; ?>