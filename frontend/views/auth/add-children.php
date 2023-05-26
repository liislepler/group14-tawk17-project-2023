<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Add your child", $this->model["error"]);
?>

<div class="container">

    <h1>Add your child</h1>

    <form autocomplete="off" action="<?= $this->home ?>/auth/add-children" method="post">
        <input type="text" name="username" placeholder="Username"> <br>
        <input type="password" name="password" placeholder="Password"> <br>
        <input type="password" name="confirm_password" placeholder="Confirm password"> <br>
        <input type="hidden" name="user_role" value="child"> <br>


        <input type="hidden" name="parent_id" value="<?= $this->user->user_id ?>"> <br>


        <input type="submit" value="Continue" class="btn">
    </form>

</div>