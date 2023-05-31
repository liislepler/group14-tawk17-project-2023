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

    public function getLogsForParent($user_id)
    {
        $users_database = new UsersDatabase();
        $logs_database = new LogsDatabase();
    
        // Get the children of the parent user
        $children = $users_database->getChildrenByParentId($user_id);
    
        $logs = [];
    
        // Loop through each child and fetch their logs
        foreach ($children as $child) {
            $child_logs = $logs_database->getLogsByChildId($child->user_id);
            $logs = array_merge($logs, $child_logs);
        }
    
        return $logs;
    }

    public static function getLogsForChild($child) 
    {
        $logs_database = new LogsDatabase();

        $logs = $logs_database->getLogsByChildId($child);

        return $logs;
    }

    public static function getLogById($id){
        $logs_database = new LogsDatabase();

        $log = $logs_database->getOne($id);

        return $log;
    }

    public static function updateLogById($log_id, LogsModel $log){
        $log_database = new LogsDatabase();

        $success = $log_database->updateById($log_id, $log);

        return $success;
    }

    public static function deleteLogById($log_id)
    {
        $logs_database = new LogsDatabase();

        $success = $logs_database->deleteById($log_id);

        return $success;
    }
}