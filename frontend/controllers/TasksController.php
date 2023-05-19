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

        // GET: /home/parent-tasks/{task id}/complete
        if ($this->path_count == 4 && $this->path_parts[3] == "complete") {
            $this->showCompleteForm();
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

    private function showCompleteForm()
    {
        // Shows the view file parent-tasks/edit.php
        $this->viewPage("parent-tasks/edit");
    }


    // handle all post requests in one place
    private function handlePost()
    {
        // POST: /home/parent-tasks/{child id}/new-task
        if ($this->path_count == 4 && $this->path_parts[3] == "new-task") {
            $this->newTask();
        }

        // GET: /home/parent-tasks/{task id}/complete
        if ($this->path_count == 4 && $this->path_parts[3] == "complete") {
            $this->completeTask();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }

    private function newTask()
    {
        $task = new TasksModel();

        $selectedSchoolOptions = isset($this->body["school"]) ? $this->body["school"] : [];
        $task->school = !empty($selectedSchoolOptions) ? implode(", ", $selectedSchoolOptions) : '';
        
        $selectedChoreOptions = isset($this->body["chore"]) ? $this->body["chore"] : [];
        $task->chore = !empty($selectedChoreOptions) ? implode(", ", $selectedChoreOptions) : '';
        
        $selectedFoodOptions = isset($this->body["food"]) ? $this->body["food"] : [];
        $task->food = !empty($selectedFoodOptions) ? implode(", ", $selectedFoodOptions) : '';

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

    private function completeTask()
    {
        
    }

}
