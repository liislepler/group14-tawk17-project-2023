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
                            <button><a href="<?= $this->home ?>/parent-tasks/<?= $child->user_id ?>/new-task">New task</a></button>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
    <?php else : ?>
        <p>No children found for the parent</p>
    <?php endif; ?>
<?php endif; ?>

<?php if ($this->user->user_role === "child") : ?>
    <h1>Child view</h1>
<?php endif; ?>

<?php else : ?>
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

        <a href="<?= $this->home ?>/auth/create-account"><button>Create Account</button></a>
        <a href="<?= $this->home ?>/auth/log-in"><button>Log in</button></a>

    </div>
<?php endif; ?>