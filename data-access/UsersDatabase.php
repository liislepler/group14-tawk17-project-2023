<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class
require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/UserModel.php";

class UsersDatabase extends Database
{
    private $table_name = "users";
    private $id_name = "user_id";

    // Get one customer by using the inherited function getOneRowByIdFromTable
    public function getOne($user_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $user_id);

        $user = $result->fetch_object("UserModel");

        return $user;
    }


    // Get all users by using the inherited function getAllRowsFromTable
    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $users = [];

        while($user = $result->fetch_object("UserModel")){
            $users[] = $user;
        }

        return $users;
    }

   // Create one by creating a query and using the inherited $this->conn 
   public function insert(UserModel $user){
    $query = "INSERT INTO users (username, password, role, parentId) VALUES (?, ?, ?, ?)";

    $stmt = $this->conn->prepare($query);

    $stmt->bind_param("sssi", $user->username, $user->password, $user->role, $user->parent_id);

    $success = $stmt->execute();

    return $success;
}

// Updates one by using an update query and using the inherited $this->conn 
public function update($user_id, UserModel $user){
    $query = "UPDATE users SET username=?, password=? WHERE user_id=?;";

    $stmt = $this->conn->prepare($query);

    $stmt->bind_param("ssi", $user->username, $user->password, $user_id);

    $success = $stmt->execute();

    return $success;
}

// Delete one by using a delete query and using the inherited $this->conn 
public function delete($user_id){

    $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $user_id);

    return $success;
}
}