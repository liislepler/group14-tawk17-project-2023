<?php
require_once __DIR__ . "/../Template.php";

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
        <h1>Parent view <?= $this->user->user_role ?> </h1>

        <?php if (count($children) > 0) : ?>
            <?php foreach ($children as $child) : ?>
                <li class="one-child">
                    <div class="logs">
                        <h3><?php echo $child->username; ?>'s logs today</h3>
                        <?php
                        $LogsService = new LogsService();
                        $logs = $LogsService->getLogsForChild($child->user_id); 
                        ?>        
                        <?php foreach ($logs as $log) : ?>           
                            <div>
                                <?php if (!empty($log->emotion)) : ?>
                                    Emotion: <?= $log->emotion ?><br>
                                <?php endif; ?>
                                <?php if (!empty($log->social)) : ?>
                                    Social: <?= $log->social ?><br>
                                <?php endif; ?>
                                <?php if (!empty($log->hobby)) : ?>
                                    Hobby: <?= $log->hobby ?><br>
                                <?php endif; ?>
                                <?php if (!empty($log->school)) : ?>
                                    School: <?= $log->school ?><br>
                                <?php endif; ?>
                                <?php if (!empty($log->chore)) : ?>
                                    Chore: <?= $log->chore ?><br>
                                <?php endif; ?>
                                <?php if (!empty($log->food)) : ?>
                                    Food: <?= $log->food ?><br>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <div class="to-do-list">
                            <?php
                            $TasksService = new TasksService();
                            $tasks = $TasksService->getTasksForChild($child->user_id);
                            ?>

                            <div class="done">
                                <h3>Done</h3>
                                <?php foreach ($tasks as $task) : ?>
                                    <?php if ($task->status == "1") : ?>
                                        <div>
                                            <?php if (!empty($task->school)) : ?>
                                                School: <?= $task->school ?><br>
                                            <?php endif; ?>
                                            <?php if (!empty($task->chore)) : ?>
                                                Chore: <?= $task->chore ?><br>
                                            <?php endif; ?>
                                            <?php if (!empty($task->food)) : ?>
                                                Food: <?= $task->food ?><br>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                            <div class="to-do">
                                <h3>To-do</h3>
                                <?php foreach ($tasks as $task) : ?>
                                    <?php if ($task->status == "0") : ?>
                                        <div>
                                            <?php if (!empty($task->school)) : ?>
                                                School: <?= $task->school ?><br>
                                            <?php endif; ?>
                                            <?php if (!empty($task->chore)) : ?>
                                                Chore: <?= $task->chore ?><br>
                                            <?php endif; ?>
                                            <?php if (!empty($task->food)) : ?>
                                                Food: <?= $task->food ?><br>
                                            <?php endif; ?>
                                            <a href="<?= $this->home ?>/parent-tasks/<?= $task->task_id ?>/edit">Edit</a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <button><a href="<?= $this->home ?>/parent-tasks/<?= $child->user_id ?>/new-task">New task</a></button>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No children found for the parent</p>
        <?php endif; ?>
    </div>
<?php endif; ?>



<?php if ($this->user->user_role === "child") : ?>
<div class="child-view">
    <h1>Child view</h1>

    <div class="logs">
        <h3>Today's logs</h3>
        <?php
        $LogsService = new LogsService();
        $logs = $LogsService->getLogsForChild($this->user->user_id); 
        ?>        
        <?php foreach ($logs as $log) : ?>           
            <div>
                <?php if (!empty($log->emotion)) : ?>
                    Emotion: <?= $log->emotion ?><br>
                <?php endif; ?>
                <?php if (!empty($log->social)) : ?>
                    Social: <?= $log->social ?><br>
                <?php endif; ?>
                <?php if (!empty($log->hobby)) : ?>
                    Hobby: <?= $log->hobby ?><br>
                <?php endif; ?>
                <?php if (!empty($log->school)) : ?>
                    School: <?= $log->school ?><br>
                <?php endif; ?>
                <?php if (!empty($log->chore)) : ?>
                    Chore: <?= $log->chore ?><br>
                <?php endif; ?>
                <?php if (!empty($log->food)) : ?>
                    Food: <?= $log->food ?><br>
                <?php endif; ?>
                <a href="<?= $this->home ?>/child-logs/<?= $log->log_id ?>/edit">Edit</a>
            </div>
        <?php endforeach; ?>
        <button><a href="<?= $this->home ?>/child-logs/<?= $this->user->user_id ?>/new-log">New log</a></button>
    </div>

    <div class="to-do-list">
        <?php
        $TasksService = new TasksService();
        $tasks = $TasksService->getTasksForChild($this->user->user_id);
        ?>

        <div class="done">
            <h3>Done</h3>
            <?php foreach ($tasks as $task) : ?>
                <?php if ($task->status == "1") : ?>
                    <div>
                        <?php if (!empty($task->school)) : ?>
                            School: <?= $task->school ?><br>
                        <?php endif; ?>
                        <?php if (!empty($task->chore)) : ?>
                            Chore: <?= $task->chore ?><br>
                        <?php endif; ?>
                        <?php if (!empty($task->food)) : ?>
                            Food: <?= $task->food ?><br>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="to-do">
            <h3>To-do</h3>
            <?php foreach ($tasks as $task) : ?>
                <?php if ($task->status == "0") : ?>
                    <div>
                        <?php if (!empty($task->school)) : ?>
                            School: <?= $task->school ?><br>
                        <?php endif; ?>
                        <?php if (!empty($task->chore)) : ?>
                            Chore: <?= $task->chore ?><br>
                        <?php endif; ?>
                        <?php if (!empty($task->food)) : ?>
                            Food: <?= $task->food ?><br>
                        <?php endif; ?>
                    </div>
                    <button><a href="<?= $this->home ?>/parent-tasks/<?= $task->task_id ?>/complete">Complete</a></button>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>    
<?php endif; ?>


<?php else : ?>

    <div>
        <div class="home-page">

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


            <div class="center">
                <a href="<?= $this->home ?>/auth/create-account"><button>Create Account</button></a>
                <a href="<?= $this->home ?>/auth/log-in"><button>Log in</button></a>

            </div>

        </div>
    </div>
    </div>

<?php endif; ?>