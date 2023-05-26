<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Model class for parents-tasks-table in database

class tasksModel{
    public $task_id;
    public $school;
    public $chore;  
    public $food;  
    public $child; 
    public $status; 
    public $parent;
}