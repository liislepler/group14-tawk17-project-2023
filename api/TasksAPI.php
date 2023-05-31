<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/TasksService.php";


class TasksAPI extends RestAPI
{

    // Handles the request by calling the appropriate member function
    public function handleRequest()
    {

        // GET: /api/tasks
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getAll();
        }

        // GET: /api/tasks/{id}
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }

        // POST: /api/tasks
        else if ($this->path_count == 2 && $this->method == "POST") {
            $this->postOne();
        }

        // PUT: /api/tasks/{id}
        else if ($this->path_count == 3 && $this->method == "PUT") {
            $this->putOne($this->path_parts[2]);
        }

        // DELETE: /api/tasks/{id}
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

        if ($this->user->user_role === "parent") {
            $tasks = TasksService::getTasksByParent($this->user->user_id);
        } else {
            $tasks = TasksService::getTasksForChild($this->user->user_id);
        }

        $this->sendJson($tasks);
    }


    private function getById($id)
    {
        $this->requireAuth();

        $task = TasksService::getTaskById($id);

        if (!$task) {
            $this->notFound();
        }

        if ($task->child !== $this->user->user_id && $task->parent !== $this->user->user_id) {
            $this->forbidden();
        }

        $this->sendJson($task);
    }


    private function postOne()
    {
        $this->requireAuth();

        $task = new TasksModel();

        $task->school = $this->body["school"];
        $task->chore = $this->body["chore"];
        $task->food = $this->body["food"];
        $task->child = $this->body["child"];
        $task->status = "1";
        $task->parent = $this->user->user_id;

        $success = TasksService::addTask($task);

        if ($success) {
            $this->created();
        } else {
            $this->error();
        }
    }


    private function putOne($id)
    {
        $this->requireAuth();

        if ($this->user->user_role === "parent") {
            $task = new TasksModel();

            $task->school = $this->body["school"];
            $task->chore = $this->body["chore"];
            $task->food = $this->body["food"];

            $success = TasksService::updateTaskById($id, $task);

            if ($success) {
                $this->ok();
            } else {
                $this->error();
            }
        } else {
            $task = new TasksModel();

            $task->status = $this->body["status"];

            $success = TasksService::updateTaskById($id, $task);

            if ($success) {
                $this->ok();
            } else {
                $this->error();
            }
        }
    }

    // Deletes the task with the specified ID in the DB
    private function deleteOne($id)
    {
        // only admins can delete purchases
        $this->requireAuth(["parent"]);

        $task = TasksService::getTaskById($id);

        if ($task == null) {
            $this->notFound();
        }

        $success = TasksService::deleteTaskById($id);

        if ($success) {
            $this->noContent();
        } else {
            $this->error();
        }
    }
}