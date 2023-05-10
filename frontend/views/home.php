<?php
require_once __DIR__ . "/../Template.php";

Template::header("Home");

?>

<?php if ($this->user->user_role === "parent") : ?>
    <h1>Parent view</h1>
<?php endif; ?>

<?php if ($this->user->user_role === "child") : ?>
    <h1>Child view</h1>
<?php endif; ?>