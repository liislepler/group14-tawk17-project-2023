<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}


require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/TasksModel.php";

class TasksDatabase extends Database
{
    private $table_name = "parenttasks";
    private $id_name = "task_id";

    public function insert(TasksModel $task)
    {
        $query = "INSERT INTO parenttasks (school, chore, food, child, status) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssii", $task->school, $task->chore, $task->food, $task->child, $task->status);

        $success = $stmt->execute();

        return $success;
    }

    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $tasks = [];

        while ($task = $result->fetch_object("TasksModel")) {
            $tasks[] = $task;
        }

        return $tasks;
    }


    public function getTasksByChildId($child) {
        $query = "SELECT * FROM parenttasks WHERE child = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $child);

        $stmt->execute();

        $result = $stmt->get_result();

        $tasks = [];

        while ($task = $result->fetch_object("TasksModel")) {
            $tasks[] = $task;
        }

        return $tasks;
    }

    // Get one task by using the inherited function getOneRowByIdFromTable
    public function getOne($task_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $task_id);

        $task = $result->fetch_object("TasksModel");

        return $task;
    }

    public function completeById($task_id, TasksModel $task)
    {
        $query = "UPDATE parenttasks SET status=? WHERE task_id=?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ii", $task->status, $task_id);

        $success = $stmt->execute();

        return $success;
    }

    public function updateById($task_id, TasksModel $task)
    {
        $query = "UPDATE parenttasks SET school = ?, chore = ?, food = ? WHERE task_id = ?";

        $stmt = $this->conn->prepare($query);
    
        $stmt->bind_param("sssi", $task->school, $task->chore, $task->food, $task_id);

        $success = $stmt->execute();

        return $success;
    }

    public function deleteById($task_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $task_id);

        return $success;
    }
}