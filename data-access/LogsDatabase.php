<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}


require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/LogsModel.php";

class LogsDatabase extends Database
{
    private $table_name = "logs";
    private $id_name = "log_id";

    public function insert(LogsModel $log)
    {
        $query = "INSERT INTO logs (emotion, social, hobby, school, chore, food, child) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssssssi", $log->emotion, $log->social, $log->hobby, $log->school, $log->chore, $log->food, $log->child);

        $success = $stmt->execute();

        return $success;
    }

    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $logs = [];

        while ($log = $result->fetch_object("LogsModel")) {
            $logs[] = $log;
        }

        return $logs;
    }


    public function getLogsByChildId($child) {
        $query = "SELECT * FROM logs WHERE child = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $child);

        $stmt->execute();

        $result = $stmt->get_result();

        $logs = [];

        while ($log = $result->fetch_object("LogsModel")) {
            $logs[] = $log;
        }

        return $logs;
    }

    public function getOne($log_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $log_id);

        $log = $result->fetch_object("LogsModel");

        return $log;
    }

    public function updateById($log_id, LogsModel $log)
    {
        $query = "UPDATE logs SET emotion = ?, social = ?, hobby = ?, school = ?, chore = ?, food = ? WHERE log_id = ?";

        $stmt = $this->conn->prepare($query);
    
        $stmt->bind_param("ssssssi", $log->emotion, $log->social, $log->hobby, $log->school, $log->chore, $log->food, $log_id);

        $success = $stmt->execute();

        return $success;
    }

    public function deleteById($log_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $log_id);

        return $success;
    }

}