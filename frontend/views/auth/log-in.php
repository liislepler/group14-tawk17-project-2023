<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Login", $this->model["error"]);
?>

<div class="container">

    <h1>Welcome back!</h1>

    <form autocomplete="off" action="<?= $this->home ?>/auth/log-in" method="post">
        <h4>Username</h4>
        <input type="text" name="username" placeholder="Username"> <br>
        <h4>Password</h4>
        <input type="password" name="password" placeholder="Password"> <br>

        <button type="submit" class="dino-button">Log in</button>
    </form>

    <h3>Don't have an account?</h3> <br>

    <button><a href="<?= $this->home ?>/auth/create-account" class="btn">Create account</a></button>
    <br>


</div>