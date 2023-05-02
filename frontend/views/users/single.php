<?php
require_once __DIR__ . "/../../Template.php";

Template::header($this->model->username);
?>

<h1><?= $this->model->username ?></h1>

<p>
    <b>Id: </b>
    <?= $this->model->user_id ?> 
</p>

<p>
    <b>Username: </b>
    <?= $this->model->cusername ?> 
</p>

<p>
    <b>Role: </b>
    <?= $this->model->role ?> 
</p>


<?php Template::footer(); ?>