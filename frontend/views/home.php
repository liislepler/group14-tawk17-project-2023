<?php
require_once __DIR__ . "/../Template.php";

Template::header("Home");

?>

<link href='https://fonts.googleapis.com/css?family=Coiny' rel='stylesheet'>

<div class="home-page">

    <h1>Welcome to Trackosaurus</h1>

    <h2>
    This is Trackosaurus!
    A tracking application in which parents can track their childrens everyday doings from activities, chores, hobbies, moods, habits, etc. 
    Every day the child is prompted to record their day with fun and interactive designs by adding different activities and descriptions of their day. 
    The child can see their recorded activities in the calendar which they can update and delete at any time. 
    The admin/parent can track their children's activities to get a better insight into their activities, chores, hobbies, moods, habits, etc. in real-time.
    The children and parents can make separate accounts but each parent is connected with their childs account. 
    </h2>

    <a href="<?= $this->home ?>/create-account"><button>Create Account</button></a>

    <button>Log in </button>

</div>