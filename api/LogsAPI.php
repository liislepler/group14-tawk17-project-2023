<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/LogsService.php";


class LogsAPI extends RestAPI
{

    // Handles the request by calling the appropriate member function
    public function handleRequest()
    {

        // GET: /api/tasks
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getAll();
        }

        // GET: /api/logs/{id}
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }

        // POST: /api/logs
        else if ($this->path_count == 2 && $this->method == "POST") {
            $this->postOne();
        }

        // PUT: /api/logs/{id}
        else if ($this->path_count == 3 && $this->method == "PUT") {
            $this->putOne($this->path_parts[2]);
        }

        // DELETE: /api/logs/{id}
        else if ($this->path_count == 3 && $this->method == "DELETE") {
            $this->deleteOne($this->path_parts[2]);
        }

        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }


    private function getAll()
    {
        $this->requireAuth();
    
        $logsService = new LogsService();
    
        if ($this->user->user_role === "parent") {
            $logs = $logsService->getLogsForParent($this->user->user_id);
        } else {
            $logs = $logsService->getLogsForChild($this->user->user_id);
        }
    
        $this->sendJson($logs);
    }


    private function getById($id)
    {
        $this->requireAuth();

        $log = LogsService::getLogById($id);

        if (!$log) {
            $this->notFound();
        }

        if ($log->child !== $this->user->user_id) {
            $this->forbidden();
        }

        $this->sendJson($log);
    }


    private function postOne()
    {
        $this->requireAuth(["child"]);

        $log = new LogsModel();

        $log->child = $this->user->user_id;
        $log->emotion = $this->body["emotion"];
        $log->social = $this->body["social"];
        $log->hobby = $this->body["hobby"];
        $log->school = $this->body["school"];
        $log->chore = $this->body["chore"];
        $log->food = $this->body["food"];

        $success = LogsService::addLog($log);

        if ($success) {
            $this->created();
        } else {
            $this->error();
        }
    }


    private function putOne($id)
    {
        $this->requireAuth(["child"]);

        $log = new LogsModel();

        $log->emotion = $this->body["emotion"];
        $log->social = $this->body["social"];
        $log->hobby = $this->body["hobby"];
        $log->school = $this->body["school"];
        $log->chore = $this->body["chore"];
        $log->food = $this->body["food"];

        $success = LogsService::updateLogById($id, $log);

        if ($success) {
            $this->ok();
        } else {
            $this->error();
        }
    }

    // Deletes the task with the specified ID in the DB
    private function deleteOne($id)
    {
        $this->requireAuth(["child"]);

        $log = LogsService::getLogById($id);

        if ($log == null) {
            $this->notFound();
        }

        $success = LogsService::deleteLogById($id);

        if ($success) {
            $this->noContent();
        } else {
            $this->error();
        }
    }
}