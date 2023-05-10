<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Login", $this->model["error"]);
?>

<h1>Welcome back!</h1>

<form autocomplete="off" action="<?= $this->home ?>/auth/log-in" method="post">
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="password" name="password" placeholder="Password"> <br>
    
    <input type="submit" value="Log in" class="btn">
</form>

<div>
    <h3>Don't have an account?</h3>
    <a href="<?= $this->home ?>/auth/create-account">Create account</a>
</div>