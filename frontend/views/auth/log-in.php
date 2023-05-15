<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Login", $this->model["error"]);
?>

<div>

<h1>Welcome back!</h1>

<form autocomplete="off" action="<?= $this->home ?>/auth/log-in" method="post">
<h4>Username</h4>
    <input type="text" name="username" placeholder="Username"> <br>
    <h4>Password</h4>
    <input type="password" name="password" placeholder="Password"> <br>
<button>
    <input type="submit" value="Log in" class="btn">
</button>
</form>


    <h3>Don't have an account?</h3>
    <a href="<?= $this->home ?>/auth/create-account"><button>Create account</button></a>
</div>