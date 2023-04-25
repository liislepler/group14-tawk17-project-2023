<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class
require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/AdminUserModel.php";

class UsersDatabase extends Database
{
    private $table_name = "admins";
    private $id_name = "admin_id";

    // Get one user by using the inherited function getOneRowByIdFromTable
    public function getOne($admin_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $admin_id);

        $admin_user = $result->fetch_object("AdminUserModel");

        return $admin_user;
    }


    // Get all users by using the inherited function getAllRowsFromTable
    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $admin_users = [];

        while($admin_user = $result->fetch_object("AdminUserModel")){
            $admin_users[] = $admin_user;
        }

        return $admin_users;
    }

    // Create one by creating a query and using the inherited $this->conn 
    public function insert(AdminUserModel $admin_user){
        $query = "INSERT INTO admins (username, password) VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ss", $admin_user->username, $admin_user->password);

        $success = $stmt->execute();

        return $success;
    }

    // Updates one by using an update query and using the inherited $this->conn 
    public function update($admin_id, AdminUserModel $admin_user){
        $query = "UPDATE admins SET username=?, password=? WHERE admin_id=?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssi", $admin_user->username, $admin_user->password, $admin_id);

        $success = $stmt->execute();

        return $success;
    }

    // Delete one by using a delete query and using the inherited $this->conn 
    public function delete($admin_id){

        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $admin_id);

        return $success;
    }
}