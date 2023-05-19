<?php
require_once __DIR__ . "/../../Template.php";
require_once __DIR__ . "/../../../business-logic/UsersService.php";

$parent_id = $this->user->user_id;
$user_id = $this->user->user_id;
$usersService = new UsersService();
$children = $usersService->getChildrenForAdmin($parent_id);

Template::header("Profile", $this->model["error"]);
?>


<div class="account-settings">

    <?php if ($this->user->user_role === "parent") : ?>
        <h1>Parent account</h1>

        <a href="<?= $this->home ?>/auth/profile/<?= $user_id ?>/edit">Account settings</a>

<<<<<<< HEAD
        <?php if (count($children) > 0) : ?>
            <ul>
                <?php foreach ($children as $child) : ?>
                    <li>
                        <h3><?php echo $child->username; ?></h3>
                        <form action="<?= $this->home ?>/auth/profile/<?= $child->user_id ?>/delete" method="post" onsubmit="return confirmDelete()">
                            <input type="submit" value="Delete" class="btn delete-btn">
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No children found for the parent</p>
        <?php endif; ?>
=======
        <p>
            Logged in as <b><?= $this->user->username ?></b>
        </p>
>>>>>>> bf67e3c1376909d76f224d8547427c1bb85c954f



        <h3>Children:</h3>

<<<<<<< HEAD
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this child?");
    }
</script>

=======
        <div class="item-grid">

            <?php if (count($children) > 0) : ?>
                <ul>
                    <?php foreach ($children as $child) : ?>
                        <li>
                            <h4><?php echo $child->username; ?></h4>
                            <button>Delete</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No children found for the parent</p>
            <?php endif; ?>

        </div>
        <div>
            <a href="<?= $this->home ?>/auth/add-children">Add your children</a>
        </div>

    <?php endif; ?>

    <form action="<?= $this->home ?>/auth/log-out" method="post">
        <input type="submit" value="Log out" class="btn delete-btn">
    </form>

</div>
>>>>>>> bf67e3c1376909d76f224d8547427c1bb85c954f
