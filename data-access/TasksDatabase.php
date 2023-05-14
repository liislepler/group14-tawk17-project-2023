<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}


require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/TasksModel.php";

class TasksDatabase extends Database
{
    private $table_name = "parent-tasks";
    private $id_name = "task_id";

    public function insert(TasksModel $task)
    {
        $query = "INSERT INTO parenttasks (school, chore, food, child, status) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssii", $task->school, $task->chore, $task->food, $task->child, $task->status);

        $success = $stmt->execute();

        return $success;
    }

}