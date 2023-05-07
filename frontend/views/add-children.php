<?php
require_once __DIR__ . "/../Template.php";

Template::header("Add your children");
?>

<h1>Create Account</h1>

<form action="<?= $this->home ?>/feed" method="post">
    <h3>Child nr.1</h3>
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="text" name="password" placeholder="Password"> <br>
    <input type="hidden" name="role" value="child"> <br>

    <input type="submit" value="Continue" class="btn">
</form>
