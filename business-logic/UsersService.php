<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/UsersDatabase.php";

class UsersService{

    // Get one user by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getUserById($id){
        $user_database = new UsersDatabase();

        $user = $user_database->getOne($id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $user;
    }

    // Get all users by creating a database object 
    // from data-access layer and calling its getAll function.
    public static function getAllUsers(){
        $users_database = new UsersDatabase();

        $users = $users_database->getAll();

        return $users;
    }

    // Save an user to the database by creating a database object 
    // from data-access layer and calling its insert function.
    public static function saveUser(UserModel $user){
        $users_database = new UsersDatabase();

        $success = $users_database->insert($user);

        return $success;
    }

    // Update an user in the database by creating a database object 
    // from data-access layer and calling its update function.
    public static function updateUserById($user_id, UserModel $user){
        $users_database = new UsersDatabase();

        $success = $users_database->update($user_id, $user);

        return $success;
    }

    // Delete an user in the database by creating a database object 
    // from data-access layer and calling its delete function.
    public static function deleteUserById($user_id){
        $users_database = new UsersDatabase();

        $success = $users_database->delete($user_id);

        return $success;
    }
}