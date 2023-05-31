<?php
require_once __DIR__ . "/../../Template.php";
require_once __DIR__ . "/../../../business-logic/UsersService.php";

$parent_id = $this->user->user_id;
$user_id = $this->user->user_id;
$usersService = new UsersService();
$children = $usersService->getChildrenForParent($parent_id);

Template::header("Profile", $this->model["error"]);
?>


<div class="profile">

    <h1>Logged in as: <?= $this->user->username ?></h1>

    <?php if ($this->user->user_role === "parent") : ?>
        <h4>Parent account</h4>

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

            <div class="button">
                <a href="<?= $this->home ?>/auth/add-children" class="btn">Add your children</a>
            </div>

            <div class="button">
                <a href="<?= $this->home ?>/auth/profile/<?= $user_id ?>/edit" class="btn"> Account settings</a>
            </div>

        <?php endif; ?>

        <form action="<?= $this->home ?>/auth/log-out" method="post">
            <input type="submit" value="Log out" class="btn">
        </form>


        </div>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this child?");
    }
</script>