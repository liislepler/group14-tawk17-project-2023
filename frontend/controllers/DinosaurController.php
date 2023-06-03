<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ConrollerBase.php";
require_once __DIR__ . "/../../business-logic/DinosaurService.php";

class DinosaurController extends ControllerBase
{
    public function handleRequest()
    {
        $dinosaur = DinosaurService::getDinosaur();
        $name = $dinosaur["name"];
        $description = $dinosaur["description"];
    
        $this->model = [];
    
        if ($name && $description) {
    
            $this->model = [
                'name' => $name,
                'description' => $description,
            ];
        } 
    
        $this->viewPage("auth/profile");
    }
}

