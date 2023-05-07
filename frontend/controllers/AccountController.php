<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ConrollerBase.php";
require_once __DIR__ . "/../../business-logic/UsersService.php";

// Class for handling requests to "home/create-account"

class AccountController extends ControllerBase
{
    public function handleRequest()
    {
        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }

        // Path count is 2 meaning the current URL must be "/home/{SOMETHING}"
        else if ($this->path_count == 2 && $this->path_parts[1] == "create-account") {
            $this->showNewUserForm();
        }
        else if ($this->path_count == 2 && $this->path_parts[1] == "log-in") {
            $this->showOldUserForm();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }

    // Gets one user and shows the in the edit user-view
    private function showNewUserForm()
    {
        // Shows the view file users/new.php
        $this->viewPage("create-account");
    }

    // Gets one user and shows the in the edit user-view
    private function showOldUserForm()
    {
        // Shows the view file users/new.php
        $this->viewPage("log-in");
    }

    // handle all post requests for users in one place
    private function handlePost()
    {
        // Path count is 2 meaning the current URL must be "/home/users"
        // Create a customer
        if ($this->path_count == 2) {
            $this->createUser();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }


    // Create a user with data from the URL and body
    private function createUser()
    {
        $user = new UserModel();

        // Get updated properties from the body
        $user->username = $this->body["username"];
        $user->password = $this->body["password"];
        $user->role = $this->body["role"];

        // Save the user
        $success = UsersService::saveUser($user);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home);
        } else {
            $this->error();
        }
    }

}