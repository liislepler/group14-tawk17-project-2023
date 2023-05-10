<?php
require_once __DIR__ . "/../Template.php";

Template::header("Welcome");

?>

<link href='https://fonts.googleapis.com/css?family=Coiny' rel='stylesheet'>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@100&display=swap" rel="stylesheet">


<div class="home-page">

    <h1>Welcome to Trackersaurus</h1>

    <h2>
    This is Trackersaurus!
    A tracking application in which parents can track their childrens everyday doings from activities, chores, hobbies, moods, habits, etc. 
    Every day the child is prompted to record their day with fun and interactive designs by adding different activities and descriptions of their day. 
    </h2>
    
    <h2>
    The child can see their recorded activities in the calendar which they can update and delete at any time. 
    The admin/parent can track their children's activities to get a better insight into their activities, chores, hobbies, moods, habits, etc. in real-time.
    The children and parents can make separate accounts but each parent is connected with their childs account. 
    </h2>

    <a href="<?= $this->home ?>/auth/create-account"><button>Create Account</button></a>
    <a href="<?= $this->home ?>/auth/log-in"><button>Log in</button></a>

</div>