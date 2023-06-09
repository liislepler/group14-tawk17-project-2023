<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Create Account", $this->model["error"]);
?>

<div class="container">

<h1>Create Account</h1>

<form autocomplete="off" action="<?= $this->home ?>/auth/create-account" method="post"  onsubmit="return checkField()" id="input" >
    <h4>Username</h4>
        <input type="text" name="username" placeholder="Username"> <br>

    <h4>Password</h4>
        <input type="password" name="password" placeholder="Password"> <br>

    <h4>Confirm password</h4>
        <input type="password" name="confirm_password" placeholder="Confirm password"> <br>

    <input type="hidden" name="user_role" value="parent"> <br>
    <input type="hidden" name="parent_id" value=""> <br>

    <p>If you're a child, let your parent sign-up before</p>

    <button type="submit" class="dino-button">Sign Up</button>
</form>


    <h3>Do you have an account?</h3><br>
    <button><a href="<?= $this->home ?>/auth/log-in" class="btn">Log in</a></button>
    
</div>

<script>
    function checkField() {
        var input = document.getElementById('input');

        if (input.username.value === '' || input.password.value === '' || input.confirm_password.value === '') {
            alert('Field is empty!');
            return false; 
        }
        return true; 
    }
</script>
