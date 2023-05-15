<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/LogsDatabase.php";


class LogsService {

    public static function addLog(LogsModel $log){
        $logs_database = new LogsDatabase();

        $success = $logs_database->insert($log);

        return $success;
    }

    public static function getLogsForChild($child) 
    {
        $logs_database = new LogsDatabase();

        $logs = $logs_database->getLogsByChildId($child);

        return $logs;
    }
}