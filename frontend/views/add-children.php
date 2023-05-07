<?php
require_once __DIR__ . "/../Template.php";

Template::header("Add your children");
?>

<h1>Add your children</h1>

<h3>Child nr.1</h3>

<form autocomplete="off" action="<?= $this->home ?>/add-children" method="post">
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="text" name="password" placeholder="Password"> <br>
    <input type="hidden" name="role" value="child"> <br>
    <input type="number" name="parentId" placeholder="Parent id"> <br>


    <input type="submit" value="Continue" class="btn">
</form>


