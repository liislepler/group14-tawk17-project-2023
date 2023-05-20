<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/UsersDatabase.php";


class UsersService
{
    public static function getUserById($id){
        $users_database = new UsersDatabase();

        $user = $users_database->getOne($id);

        return $user;
    }

    public static function getUserByUsername($username)
    {
        $users_database = new UsersDatabase();

        $user = $users_database->getByUsername($username);

        return $user;
    }

    // Get all users by creating a database object 
    // from data-access layer and calling its getAll function.
    public static function getAllUsers(){
        $users_database = new UsersDatabase();

        $users = $users_database->getAll();

        return $users;
    }

    public static function updateUser($user_id, UserModel $user)
    {
        $users_database = new UsersDatabase();

        $success = $users_database->updateById($user_id, $user);

        return $success;
    }

    public static function getChildrenForParent($user_id) 
    {
        $users_database = new UsersDatabase();

        $children = $users_database->getChildrenByParentId($user_id);

        return $children;
    }

    public static function deleteUserById($user_id)
    {
        $users_database = new UsersDatabase();

        $success = $users_database->deleteById($user_id);

        return $success;
    }

    public function deleteChildrenByParentId($user_id)
    {
        $users_database = new UsersDatabase();

        // Get the children of the parent user
        $children = $users_database->getChildrenByParentId($user_id);

        // Delete each child user
        foreach ($children as $child) {
            $success = $users_database->deleteById($child->user_id);
        }

        return $success;
    }
}