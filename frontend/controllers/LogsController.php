<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ConrollerBase.php";
require_once __DIR__ . "/../../business-logic/LogsService.php";

// Class for handling requests to "home/child-logs"

class LogsController extends ControllerBase
{

    public function handleRequest()
    {

        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }

        // /home/{child id}/new-task
        if ($this->path_count == 4 && $this->path_parts[3] == "new-log") {
            $this->showNewLogForm();
        }

        // /home/child-log/{log id}/edit
        if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->showEditForm();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }


    private function showNewLogForm()
    {
        // Shows the view file child-logs/new-log.php
        $this->viewPage("child-logs/new-log");
    }

    private function showEditForm()
    {
        // Shows the view file child-logs/id/edit.php
        $this->viewPage("child-logs/edit");
    }



    // handle all post requests in one place
    private function handlePost()
    {
        // /home/child-logs/{child id}/new-log
        if ($this->path_count == 4 && $this->path_parts[3] == "new-log") {
            $this->newLog();
        }

        // /home/child-logs/{id}/edit
        if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->editLog();
        }

        // /home/child-logs/{log id}/delete
        if ($this->path_count == 4 && $this->path_parts[3] == "delete") {
            $this->deleteLog();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }

    private function newLog()
    {
        $log = new LogsModel();

        $selectedEmotionOptions = isset($this->body["emotion"]) ? $this->body["emotion"] : [];
        $log->emotion = !empty($selectedEmotionOptions) ? implode(", ", $selectedEmotionOptions) : '';
        
        $selectedSocialOptions = isset($this->body["social"]) ? $this->body["social"] : [];
        $log->social = !empty($selectedSocialOptions) ? implode(", ", $selectedSocialOptions) : '';
        
        $selectedHobbyOptions = isset($this->body["hobby"]) ? $this->body["hobby"] : [];
        $log->hobby = !empty($selectedHobbyOptions) ? implode(", ", $selectedHobbyOptions) : '';
        
        $selectedSchoolOptions = isset($this->body["school"]) ? $this->body["school"] : [];
        $log->school = !empty($selectedSchoolOptions) ? implode(", ", $selectedSchoolOptions) : '';
        
        $selectedChoreOptions = isset($this->body["chore"]) ? $this->body["chore"] : [];
        $log->chore = !empty($selectedChoreOptions) ? implode(", ", $selectedChoreOptions) : '';
        
        $selectedFoodOptions = isset($this->body["food"]) ? $this->body["food"] : [];
        $log->food = !empty($selectedFoodOptions) ? implode(", ", $selectedFoodOptions) : '';

        $log->child = $this->body["child"];

        $success = LogsService::addLog($log);

        if ($success) {
                $this->redirect($this->home);
        } else {
            $this->model["error"] == "Error adding a log";
            $this->viewPage("child-logs/new-log");
        }
    }

    private function editLog()
    {
        $log = new LogsModel();

        // Get ID from the URL
        $id = $this->path_parts[2];

        $selectedEmotionOptions = isset($this->body["emotion"]) ? $this->body["emotion"] : [];
        $log->emotion = !empty($selectedEmotionOptions) ? implode(", ", $selectedEmotionOptions) : '';
        
        $selectedSocialOptions = isset($this->body["social"]) ? $this->body["social"] : [];
        $log->social = !empty($selectedSocialOptions) ? implode(", ", $selectedSocialOptions) : '';
        
        $selectedHobbyOptions = isset($this->body["hobby"]) ? $this->body["hobby"] : [];
        $log->hobby = !empty($selectedHobbyOptions) ? implode(", ", $selectedHobbyOptions) : '';
        
        $selectedSchoolOptions = isset($this->body["school"]) ? $this->body["school"] : [];
        $log->school = !empty($selectedSchoolOptions) ? implode(", ", $selectedSchoolOptions) : '';
        
        $selectedChoreOptions = isset($this->body["chore"]) ? $this->body["chore"] : [];
        $log->chore = !empty($selectedChoreOptions) ? implode(", ", $selectedChoreOptions) : '';
        
        $selectedFoodOptions = isset($this->body["food"]) ? $this->body["food"] : [];
        $log->food = !empty($selectedFoodOptions) ? implode(", ", $selectedFoodOptions) : '';

        $success = LogsService::updateLogById($id, $log);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home);
        } else {
            $this->error();
        }
    }

    private function deleteLog()
    {
        // Get ID from the URL
        $id = $this->path_parts[2];

        $success = LogsService::deleteLogById($id);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home);
        } else {
            $this->error();
        }
    }

}
