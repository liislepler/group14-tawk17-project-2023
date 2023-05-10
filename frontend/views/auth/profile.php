<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Profile", $this->model["error"]);
?>

<p>
    Logged in as <b><?= $this->user->username ?></b>
</p>

<?php if ($this->user->user_role === "parent") : ?>
    <p>Parent account</p>
    <div>
        <a href="<?= $this->home ?>/auth/add-children">Add your children</a>
    </div>
    <div class="item-grid">

        <?php foreach ($this->model as $users) : ?>

            <article class="item">
                <div>
                    <b><?= $user->username ?></b> <br>
                </div>
                    <p>
                        <b>Parent ID: </b>
                        <?= $user->parent_id ?>
                    </p>
            </article>

        <?php endforeach; ?>

    </div>
<?php endif; ?>

<form action="<?= $this->home ?>/auth/log-out" method="post">
    <input type="submit" value="Log out" class="btn delete-btn">
</form>

