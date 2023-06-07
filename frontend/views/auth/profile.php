<?php
require_once __DIR__ . "/../../Template.php";
require_once __DIR__ . "/../../../business-logic/UsersService.php";

$parent_id = $this->user->user_id;
$user_id = $this->user->user_id;
$usersService = new UsersService();
$children = $usersService->getChildrenForParent($parent_id);

Template::header("Profile");
?>

<div class="profile">

    <h1>Logged in as: <?= $this->user->username ?></h1>

    <div class="item-grid">

        <h3>Dinosaur of the day:</h3>

        <h5><?php echo $this->model['name'] ?? 'No dinosaur name found.'; ?></h5>

        <h5><?php echo $this->model['description'] ?? 'No dinosaur description found.'; ?></h5>

        <button class="dino-button" onclick="refreshPage()">Show me a new dino!</button>
    </div>

    <div class="account-settings">

        <?php if ($this->user->user_role === "parent") : ?>
            <div class="item-grid">
                <h3>Children:</h3>
                <div class="children-list">
                    <?php if (count($children) > 0) : ?>
                        <ul>
                            <?php foreach ($children as $child) : ?>
                                <div class="to-do">
                                    <li>
                                        <h3><?php echo $child->username; ?></h3>
                                        <form action="<?= $this->home ?>/auth/profile/<?= $child->user_id ?>/delete-child" method="post" onsubmit="return confirmDelete()">


                                            <input type="submit" value="Delete" class="btn delete-btn">
                                        </form>
                                    </li>
                                </div>
                            <?php endforeach; ?>
                        </ul>
                </div>
            <?php else : ?>
                <p>No children found for the parent</p>
            <?php endif; ?>

          
            <button><a href="<?= $this->home ?>/auth/add-children" class="btn">Add your children</a></button>

        <?php endif; ?>

        <div class="settings">
            <button><a href="<?= $this->home ?>/auth/profile/<?= $user_id ?>/edit" class="btn"> Account settings</a>
        </div>

        <form action="<?= $this->home ?>/auth/log-out" method="post">
            <input type="submit" value="Log out" class="logout">
        </form>


            </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this child?");
        }

        function refreshPage() {
            location.reload();
        }
    </script>