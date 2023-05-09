<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Profile");
?>

<p>
    Logged in as <b><?= $this->user->username ?></b>
</p>

<?php if ($this->user->user_role === "parent") : ?>
    <p>Parent</p>
<?php endif; ?>


<h2>Log out</h2>
<form action="<?= $this->home ?>/auth/log-out" method="post">
    <input type="submit" value="Log out" class="btn delete-btn">
</form>

