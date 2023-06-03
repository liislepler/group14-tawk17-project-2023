<?php
require_once __DIR__ . "/../Template.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

Template::header("Dinosaur Home");
$user = getUser();

?>

<h1>Dinosaur home</h1>

<form action="" method="get">
    <input type="number" name="name" placeholder="Dinosaur name"> <br>
    <input type="number" name="description" placeholder="Description"> <br>
    <input type="submit" value="Show me dinos!" class="btn">
</form>


<?= $this->model ?>

<?php Template::footer(); ?>