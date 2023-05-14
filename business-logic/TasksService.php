<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/TasksDatabase.php";


class TasksService {

    public static function addTask(TasksModel $task){
        $tasks_database = new tasksDatabase();

        $success = $tasks_database->insert($task);

        return $success;
    }
}