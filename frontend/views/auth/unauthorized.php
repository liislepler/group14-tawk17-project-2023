<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Unauthorized");
?>

<h1>Unauthorized</h1>

<p>
    You're not authorized to view this page
</p>

<?php if ($this->user) : ?>
    <p>
        Return home:
        <a href="<?= $this->home ?>/">Home</a>
    </p>
<?php else : ?>
    <p>
        Login here:
        <a href="<?= $this->home ?>/auth/log-in">Log in</a>
    </p>

    <p>
        Don't have an account?
        <a href="<?= $this->home ?>/auth/create-account">Create account</a>
    </p>

<?php endif; ?>