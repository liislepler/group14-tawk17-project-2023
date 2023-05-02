<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit " . $this->model->username);
?>

<h1>Edit <?= $this->model->username ?></h1>

<form action="<?= $this->home ?>/users/<?= $this->model->user_id ?>/edit" method="post">
    <input type="text" name="username" value="<?= $this->model->username ?>" placeholder="Username"> <br>
    <input type="text" name="password" value="<?= $this->model->password ?>" placeholder="Password"> <br>
    <input type="text" name="role" value="<?= $this->model->role ?>" placeholder="Role"> <br>
    <input type="submit" value="Save" class="btn">
</form>

<form action="<?= $this->home ?>/users/<?= $this->model->user_id ?>/delete" method="post">
    <input type="submit" value="Delete" class="btn delete-btn">
</form>

<?php Template::footer(); ?>