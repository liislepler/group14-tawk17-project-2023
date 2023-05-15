<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ConrollerBase.php";
require_once __DIR__ . "/../../business-logic/TasksService.php";

// Class for handling requests to "home/parent-tasks"

class TasksController extends ControllerBase
{

    public function handleRequest()
    {

        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }

        // GET: /home/{child id}/new-task
        if ($this->path_count == 4 && $this->path_parts[3] == "new-task") {
            $this->showNewTaskForm();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }


    private function showNewTaskForm()
    {
        // Shows the view file parent-tasks/new-task.php
        $this->viewPage("parent-tasks/new-task");
    }


    // handle all post requests in one place
    private function handlePost()
    {
        // POST: /home/parent-tasks/{child id}/new-task
        if ($this->path_count == 4 && $this->path_parts[3] == "new-task") {
            $this->newTask();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }

    private function newTask()
    {
        $task = new TasksModel();

        $selectedSchoolOptions = $this->body["school"];
        $task->school = implode(", ", $selectedSchoolOptions);
        
        $selectedChoreOptions = $this->body["chore"];
        $task->chore = implode(", ", $selectedChoreOptions);
        
        $selectedFoodOptions = $this->body["food"];
        $task->food = implode(", ", $selectedFoodOptions);

        $task->child = $this->body["child"];
        $task->status = "0";

        $success = TasksService::addTask($task);

        if ($success) {
                $this->redirect($this->home);
        } else {
            $this->model["error"] == "Error adding a task";
            $this->viewPage("parent-tasks/new-task");
        }
    }

}
