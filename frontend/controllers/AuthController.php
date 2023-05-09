<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../business-logic/AuthService.php";

// Class for handling requests to "home/Auth"

class AuthController extends ControllerBase
{

    public function handleRequest()
    {

        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }



        // GET: /home/auth/login
        if ($this->path_count == 3 && $this->path_parts[2] == "log-in") {
            $this->showLoginForm();
        }

        // GET: /home/auth/register
        if ($this->path_count == 3 && $this->path_parts[2] == "create-account") {
            $this->showCreateAccountForm();
        }

        // GET: /home/auth/profile
        if ($this->path_count == 3 && $this->path_parts[2] == "profile") {
            $this->showProfilePage();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }



    private function showLoginForm()
    {
        // Shows the view file auth/log-in.php
        $this->viewPage("auth/log-in");
    }

    private function showCreateAccountForm()
    {
        // Shows the view file auth/create-account.php
        $this->viewPage("auth/create-account");
    }

    private function showProfilePage()
    {
        // Shows the view file auth/register.php
        $this->viewPage("auth/profile");
    }


    // handle all post requests in one place
    private function handlePost()
    {
        // POST: /home/auth/log-in
        if ($this->path_count == 3 && $this->path_parts[2] == "log-in") {
            $this->loginUser();
        }

        // POST: /home/auth/create-account
        else if ($this->path_count == 3 && $this->path_parts[2] == "create-account") {
            $this->registerUser();
        }

        // POST: /home/auth/log-out
        else if ($this->path_count == 3 && $this->path_parts[2] == "log-out") {
            $this->logoutUser();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }


    private function loginUser()
    {
        $username = $this->body["username"];
        $test_password = $this->body["password"];

        $user = AuthService::authenticateUser($username, $test_password);

        if ($user === false) {
            $this->model["error"] = "Invalid credentials";
            $this->viewPage("auth/log-in");
        }

        $_SESSION["user"] = $user;

        $this->redirect($this->home . "/auth/profile");
    }


    private function registerUser()
    {
        $user = new UserModel();

        $user->username = $this->body["username"];
        $user->user_role = "user"; // hard code all new users to regular "user" role
        $password = $this->body["password"];
        $confirm_password = $this->body["confirm_password"];

        if ($password !== $confirm_password) {
            $this->model["error"] == "Passwords don't match";
            $this->viewPage("auth/create-account");
        }

        $existing_user = UsersService::getUserByUsername($user->username);

        if ($existing_user) {
            $this->model["error"] == "Username already in use";
            $this->viewPage("auth/create-account");
        }

        $success = AuthService::registerUser($user, $password);

        if ($success) {
            $this->redirect($this->home . "/auth/log-in");
        } else {
            $this->model["error"] == "Error creating an account";
            $this->viewPage("auth/create-account");
        }
    }


    private function logoutUser()
    {
        session_destroy();

        $this->redirect($this->home . "/auth/log-in");
    }


}