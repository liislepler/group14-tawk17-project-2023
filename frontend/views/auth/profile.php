<?php
require_once __DIR__ . "/../../Template.php";
require_once __DIR__ . "/../../../business-logic/UsersService.php";

$parent_id = $this->user->user_id;
$user_id = $this->user->user_id;
$usersService = new UsersService();
$children = $usersService->getChildrenForAdmin($parent_id); 

Template::header("Profile", $this->model["error"]);
?>

<p>
    Logged in as <b><?= $this->user->username ?></b>
</p>

<div class="account-settings">
    <a href="<?= $this->home ?>/auth/profile/<?= $user_id ?>/edit">Account settings</a>
</div>

<?php if ($this->user->user_role === "parent") : ?>
    <p>Parent account</p>

    <h1>Children</h1>
    <div class="item-grid">

        <?php if (count($children) > 0) : ?>
            <ul>
                <?php foreach ($children as $child) : ?>
                    <li><h3><?php echo $child->username; ?></h3>
                    <button>Delete</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No normal users found for the admin.</p>
        <?php endif; ?>

    </div>
    <div>
        <a href="<?= $this->home ?>/auth/add-children">Add your children</a>
    </div>

<?php endif; ?>

<form action="<?= $this->home ?>/auth/log-out" method="post">
    <input type="submit" value="Log out" class="btn delete-btn">
</form>

