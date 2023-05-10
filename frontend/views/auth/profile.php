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
                        <b>User ID: </b>
                        <?= $purchase->user_id ?>
                    </p>
                <a href="<?= $this->home ?>/purchases/<?= $purchase->purchase_id ?>/edit">Edit</a>
            </article>

        <?php endforeach; ?>

    </div>
<?php endif; ?>

<form action="<?= $this->home ?>/auth/log-out" method="post">
    <input type="submit" value="Log out" class="btn delete-btn">
</form>

