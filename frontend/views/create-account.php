<?php
require_once __DIR__ . "/../Template.php";

Template::header("Create Account");
?>

<h1>Create Account</h1>

<form autocomplete="off" action="<?= $this->home ?>/create-account" method="post">
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="text" name="password" placeholder="Password"> <br>
    <input type="hidden" name="role" value="parent"> <br>
    <p>If you're a child, let your parent sign-up before</p>
    <input type="submit" value="Sign Up" class="btn">
</form>

<div>
    <h3>Have an account?</h3>
    <a href="<?= $this->home ?>/log-in">Log in</a>
</div>