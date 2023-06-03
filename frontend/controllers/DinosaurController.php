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
        $name = isset($this->query_params["name"]) ? $this->query_params["name"] : null;
        $description = isset($this->query_params["description"]) ? $this->query_params["description"] : null;
    
        $this->model = [];
    
        if ($name && $description) {
            // Get name and description
            $nameData = DinosaurService::getName();
            $descriptionData = DinosaurService::getDescription();
    
            $this->model = [
                'name' => $nameData,
                'description' => $descriptionData,
            ];
        } else if ($name) {
            // Get name and all descriptions
            $nameData = DinosaurService::getName();
    
            $this->model = [
                'name' => $nameData,
            ];
        }

        var_dump($this->model);
    
        $this->viewPage("auth/profile");
    }
}

