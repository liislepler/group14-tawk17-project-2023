<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Users");
?>

<h1>Users</h1>

<a href="<?= $this->home ?>/users/new">Create new</a>

<div class="item-grid">

    <?php foreach ($this->model as $user) : ?>

        <article class="item">
            <div>
                <b><?= $user->username ?></b> <br>
                <span>Role: <?= $user->role ?></span> <br>
            </div>

            <a href="<?= $this->home ?>/users/<?= $user->user_id ?>">Show</a>
            <a href="<?= $this->home ?>/users/<?= $user->user_id ?>/edit">Edit</a>
        </article>

    <?php endforeach; ?>

</div>
