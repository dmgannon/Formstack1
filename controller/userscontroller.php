<?php

require_once 'model/UsersService.php';

class UsersController
{
    private $usersService = NULL;

    /**
    * Constructs a new instance of "UserServices"
    *
    * This is to be used to connect to the database
    */
    public function __construct()
    {
        $this->usersService = new UsersService();
    }

    /**
    * Redirect function that redirects to a given location
    */
    public function redirect($location)
    {
        header('Location: '.$location);
    }


    /**
    * Handles requests for each list, new, edit, delete, and show function.
    * Also handles "Page not found" errors and messages
    */
    public function handleRequest()
    {
        $op = isset($_GET['op'])?$_GET['op']:NULL;
        try
        {
            if(!$op || $op == 'list')
            {
                $this->listUsers();
            } elseif($op == 'new')
            {
                $this->saveUser();
            } elseif($op == 'edit')
            {
                $this->editUser();
            } elseif($op == 'delete')
            {
                $this->deleteUser();
            } elseif($op == 'show')
            {
                $this->showUser();
            } else
            {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch (Exception $e)
        {
            $this->showError("Application error", $e->getMessage());
        }
    }

    /**
    * Function for when operation "list" gets called.
    *
    * Calls "getAllUsers" function from the UserService.php
    * Includes the main view that shows all the users.
    */
    public function listUsers()
    {
        $users = $this->usersService->getAllUsers();
        include 'view/users.php';
    }

    /**
    * Function for when operation "new" gets called.
    * 
    * Collects data from the form on 'view/user-form.php'.
    * Saves the data as variables that then gets passed
    * to the "createUser" function in UsersService.
    * Redirects when complete.S
    */
    public function saveUser()
    {
        $title = 'Add new user';
        $email = '';
        $first_name = '';
        $last_name = '';
        $password = '';
        $errors = array();
         
        if (isset($_POST['form-submitted']))
        {
            $email = isset($_POST['email'])?$_POST['email']:NULL;
            $first_name = isset($_POST['first_name'])?$_POST['first_name']:NULL;
            $last_name = isset($_POST['last_name'])?$_POST['last_name']:NULL;
            $password = isset($_POST['password'])?$_POST['password']:NULL;
             
            try
            {
                $this->usersService->createUser($email, $first_name, $last_name, $password);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e)
            {
                $errors = $e->getErrors();
            }
        }
        include 'view/user-form.php';    
    }

    /**
    * Function for when operation "delete" gets called.
    *
    * Collects the id number from the deleted user
    * and saves it as a variable. We pass this variable
    * to the "deleteUser" function in UsersService.
    */
    public function deleteUser()
    {
        $id=isset($_GET['id'])?$_GET['id']:NULL;
        if(!$id)
        {
            throw new Exception('Internal Error');
        }
        $this->usersService->deleteUser($id);
        $this->redirect('index.php');
    }

    /**
    * Function for when operation "edit" gest called.
    *
    * Collects data from the form on "edit-form.php".
    * Saves the data as variables and then passes them
    * to function "editUser" in UsersService.
    * Redirects when complete.
    */
    public function editUser()
    {
        $id = '';
        $email = '';
        $first_name = '';
        $last_name = '';
        $password = '';
        $errors = array();
     
        if (isset($_POST['form-submitted']))
        {
            $id = isset($_POST['id'])?$_POST['id']:NULL;
            $email = isset($_POST['email'])?$_POST['email']:NULL;
            $first_name = isset($_POST['first_name'])?$_POST['first_name']:NULL;
            $last_name = isset($_POST['last_name'])?$_POST['last_name']:NULL;
            $password = isset($_POST['password'])?$_POST['password']:NULL;
             
            try
            {
                $this->usersService->editUser($id, $email, $first_name, $last_name, $password);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e)
            {
                $errors = $e->getErrors();
            }
        }

        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if (!$id)
        {
            throw new Exception('Internal error.');
        }
        $user = $this->usersService->getUser($id);
         
        include 'view/edit-form.php';
    }

    /**
    * Function for when operation "show" gets called.
    *
    * Collects the id number from the selected user
    * and saves it as a variable. We pass this variable
    * to the "getUser" function in UsersService.
    * Data is viewed on its own page "view/user.php".
    */
    public function showUser()
    {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if (!$id)
        {
            throw new Exception('Internal error.');
        }
        $user = $this->usersService->getUser($id);
         
        include 'view/user.php';
    }

    /**
    * Function for when an error occurs.
    * Gets viewed on its own page "view/error.php"
    */
    public function showError($title, $message)
    {
        include 'view/error.php';
    }
}