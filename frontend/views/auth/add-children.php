<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Add your children", $this->model["error"]);
?>

<h1>Add your children</h1>

<h3>Child nr.1</h3>

<form autocomplete="off" action="<?= $this->home ?>/auth/add-children" method="post">
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="text" name="password" placeholder="Password"> <br>
    <input type="password" name="confirm_password" placeholder="Confirm password"> <br>
    <input type="hidden" name="user_role" value="child"> <br>
    
    
    <input type="number" name="parent_id" value="<?= $this->user->user_id ?>" placeholder="<?= $this->user->user_id ?>"> <br>


    <input type="submit" value="Continue" class="btn">
</form>


