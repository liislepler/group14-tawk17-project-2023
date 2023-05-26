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

        // /home/{child id}/new-task
        if ($this->path_count == 4 && $this->path_parts[3] == "new-task") {
            $this->showNewTaskForm();
        }

        // /home/parent-tasks/{task id}/complete
        if ($this->path_count == 4 && $this->path_parts[3] == "complete") {
            $this->showCompleteForm();
        }

        // /home/parent-tasks/{task id}/edit
        if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->showEditForm();
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
        // Shows the view file parent-tasks/complete.php
        $this->viewPage("parent-tasks/complete");
    }

    private function showEditForm()
    {
        // Shows the view file parent-tasks/edit.php
        $this->viewPage("parent-tasks/edit");
    }


    // handle all post requests in one place
    private function handlePost()
    {
        // /home/parent-tasks/{child id}/new-task
        if ($this->path_count == 4 && $this->path_parts[3] == "new-task") {
            $this->newTask();
        }

        // /home/parent-tasks/{task id}/complete
        if ($this->path_count == 4 && $this->path_parts[3] == "complete") {
            $this->completeTask();
        }

        // /home/parent-tasks/{task id}/edit
        if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->editTask();
        }

        // /home/parent-tasks/{task id}/delete
        if ($this->path_count == 4 && $this->path_parts[3] == "delete") {
            $this->deleteTask();
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
        $task->parent = $this->body["parent"];
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
        $task = new TasksModel();

        // Get ID from the URL
        $id = $this->path_parts[2];

        $task->status = $this->body["status"];

        $success = TasksService::completeTaskById($id, $task);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home);
        } else {
            $this->error();
        }
    }

    private function editTask()
    {
        $task = new TasksModel();

        // Get ID from the URL
        $id = $this->path_parts[2];

        $selectedSchoolOptions = isset($this->body["school"]) ? $this->body["school"] : [];
        $task->school = !empty($selectedSchoolOptions) ? implode(", ", $selectedSchoolOptions) : '';
        
        $selectedChoreOptions = isset($this->body["chore"]) ? $this->body["chore"] : [];
        $task->chore = !empty($selectedChoreOptions) ? implode(", ", $selectedChoreOptions) : '';
        
        $selectedFoodOptions = isset($this->body["food"]) ? $this->body["food"] : [];
        $task->food = !empty($selectedFoodOptions) ? implode(", ", $selectedFoodOptions) : '';

        $success = TasksService::updateTaskById($id, $task);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home);
        } else {
            $this->error();
        }
    }

    private function deleteTask()
    {
        // Get ID from the URL
        $id = $this->path_parts[2];

        $success = TasksService::deleteTaskById($id);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home);
        } else {
            $this->error();
        }
    }

}
