<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Model class for logs-table in database

class LogsModel{
    public $log_id;
    public $child;
    public $emotion;
    public $social;  
    public $hobby;  
    public $school; 
    public $chore; 
    public $food; 
}