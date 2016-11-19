<?php

require_once 'model/UsersGateway.php';
require_once 'model/ValidationException.php';

class UsersService
{
    private $usersGateway = NULL;

    /**
    * Function to connect to the database.
    */
    private function connectDb()
    {
        $connection = mysqli_connect("localhost", "my_app", "secret", "my_app");
        return $connection;
    }

    /**
    * Function to close to the database.
    */
    private function closeDb($connection)
    {
        $connection->close();
    }

    /**
    * Constructs a new instance of UsersGateway
    *
    * This is to be used to call specific queries
    */
    public function __construct()
    {
        $this->usersGateway = new UsersGateway();
    }

    /**
    * Function that selects all users from database.
    *
    * Connects to the DB through the "connectDb" function
    * and closes through the "closeDb" function.
    * Uses the "selectAll" function from UsersGateway
    * to pull results from all users.
    */
    public function getAllUsers()
    {
        try
        {
            $conn = $this->connectDb();
            $results=$this->usersGateway->selectAll($conn);
            $this->closeDb($conn);
            return $results;
        }catch(Exception $e)
        {
            $this->closeDb();
            throw $e;
        }
    }

    /**
    * Function that gets user data.
    *
    * Uses "selectById" function from UsersGateway
    * to pull results of a single user.
    */
    public function getUser($id)
    {
        try
        {
            $conn = $this->connectDb();
            $results = $this->usersGateway->selectById($id, $conn);
            $this->closeDb($conn);
            return $results;
        } catch (Exception $e)
        {
            $this->closeDb($conn);
            throw $e;
        }
        return $this->usersGateway->find($id);
    }

    /**
    * Function that validates user parameters.
    *
    * Collects email, first name, last name, and password
    * and makes sure at least the email is entered.
    * Can be changed to require all if wanted. Just simplicity for now.
    */
    private function validateUserParams($email, $first_name, $last_name, $password)
    {
        $errors = array();
        if(!isset($email)||empty($email))
        {
            $errors[]='Email is required';
        }
        if (empty($errors))
        {
            return;
        }
        throw new ValidationException($errors);
    }

    /**
    * Function that creates a user.
    *
    * Collects user data from the form and sends
    * it to function "insert" from UsersGateway.
    * 
    */
    public function createUser($email, $first_name, $last_name, $password)
    {
        try
        {
            $conn = $this->connectDb();
            $this->validateUserParams($email, $first_name, $last_name, $password);
            $results = $this->usersGateway->insert($email, $first_name, $last_name, $password, $conn);
            $this->closeDb($conn);
            return $results;
        }catch (Exception $e)
        {
            $this->closeDb($conn);
            throw $e;
        }
    }

    /**
    * Function that edits a specific user.
    *
    * Collects user data entered in the edit form
    * and sends it to the "edit" function from UsersGateway.
    */
    public function editUser($id, $email, $first_name, $last_name, $password)
    {
        try
        {
            $conn = $this->connectDb();
            $this->validateUserParams($email, $first_name, $last_name, $password);
            $results = $this->usersGateway->edit($id, $email, $first_name, $last_name, $password, $conn);
            $this->closeDb($conn);
        }catch (Exception $e)
        {
            $this->closeDb($conn);
            throw $e;
        }
    }

    /**
    * Function that deletes a specific user.
    *
    * Collects the id of the selected user and
    * sends it to the "delete" function in UsersGateway.
    */
    public function deleteUser($id)
    {
        try
        {
            $conn = $this->connectDb();
            $results = $this->usersGateway->delete($id, $conn);
            $this->closeDb($conn);
        }catch (Exception $e)
        {
            $this->closeDb($conn);
            throw $e;
        }
    }
}