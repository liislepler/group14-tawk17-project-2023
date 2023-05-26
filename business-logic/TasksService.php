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

    public static function getTasksByParent($parent){
        $tasks_database = new TasksDatabase();

        $tasks = $tasks_database->getByParentId($parent);

        return $tasks;
    }

    public static function getTasksForChild($child) 
    {
        $tasks_database = new TasksDatabase();

        $tasks = $tasks_database->getTasksByChildId($child);

        return $tasks;
    }

    public static function getTaskById($id){
        $tasks_database = new TasksDatabase();

        $task = $tasks_database->getOne($id);

        return $task;
    }

    public static function completeTaskById($task_id, TasksModel $task){
        $task_database = new TasksDatabase();

        $success = $task_database->completeById($task_id, $task);

        return $success;
    }

    public static function updateTaskById($task_id, TasksModel $task){
        $task_database = new TasksDatabase();

        $success = $task_database->updateById($task_id, $task);

        return $success;
    }

    public static function deleteTaskById($task_id)
    {
        $tasks_database = new TasksDatabase();

        $success = $tasks_database->deleteById($task_id);

        return $success;
    }
}