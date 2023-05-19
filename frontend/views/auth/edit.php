<?php
require_once __DIR__ . "/../../Template.php";
$user_id = $this->user->user_id;

Template::header("Edit your account");
?>

<div>

    <h1>Edit your account</h1>

    <form action="<?= $this->home ?>/auth/profile/<?= $user_id ?>/edit" method="post">
        <input type="text" name="username" value="<?= $this->user->username ?>" placeholder="Username"> <br>

        <input type="submit" value="Save" class="btn">
    </form>

    <form action="<?= $this->home ?>/auth/profile/<?= $user_id ?>/delete" method="post">
        <input type="submit" value="Delete" class="btn delete-btn">
    </form>

</div>