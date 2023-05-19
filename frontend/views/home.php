<?php
require_once __DIR__ . "/../Template.php";

Template::header("Home");
$user = getUser();

?>

<?php if ($user) : ?>
    <?php
    $parent_id = $this->user->user_id;
    $usersService = new UsersService();
    $children = $usersService->getChildrenForAdmin($parent_id);
    ?>

    <div>
        <?php if ($this->user->user_role === "parent") : ?>
            <h1>Parent view</h1>

            <?php if (count($children) > 0) : ?>
                <ul>
                    <?php foreach ($children as $child) : ?>
                        <li>
                            <h3><?php echo $child->username; ?></h3>
                            <div class="done">
                                <h3>Done</h3>
                            </div>
                            <div class="to-do">
                                <h3>To-do</h3>
                                <?php
                                $TasksService = new TasksService();
                                $tasks = $TasksService->getTasksForChild($child->user_id);
                                ?>

                                <?php foreach ($tasks as $task) : ?>

                                    <?php if ($task->child ==  $child->user_id) : ?>
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
                                <button><a href="<?= $this->home ?>/parent-tasks/<?= $child->user_id ?>/new-task">New task</a></button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No children found for the parent</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if ($this->user->user_role === "child") : ?>

        <div>
            <h1>Child view</h1>
    <h3><?php $this->user->username; ?></h3>
    <div class="done">
        <h3>Done</h3>
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
            </div>
        <?php endforeach; ?>
        <button><a href="<?= $this->home ?>/child-logs/<?= $this->user->user_id ?>/new-log">New log</a></button>
    </div>
    <div class="to-do">
        <h3>To-do</h3>
        <?php
        $TasksService = new TasksService();
        $tasks = $TasksService->getTasksForChild($this->user->user_id); 
        ?>   
        <?php foreach ($tasks as $task) : ?>           
            <?php if ($task->child ==  $this->user->user_id) : ?>
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
                    <button><a href="<?= $this->home ?>/parent-tasks/<?= $task->task_id ?>/complete">Complete</a></button>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
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
                The admin/parent can track their children's activities to get a better insight into their activities, chores, hobbies, moods, habits, etc. in real-time.
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

<?php endif; ?>