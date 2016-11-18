<?php

require_once 'model/UsersService.php';

class UsersController{

	private $usersService = NULL;

	public function __construct() {
		$this->usersService = new UsersService();
	}

	public function redirect($location) {
		header('Location: '.$location);
	}

	public function handleRequest(){
        $op = isset($_GET['op'])?$_GET['op']:NULL;
        try {
            if ( !$op || $op == 'list' ) {
                $this->listUsers();
            } elseif ( $op == 'new' ) {
                $this->saveUser();
            } elseif ( $op == 'edit' ) {
                $this->editUser();
            } elseif ( $op == 'delete' ) {
                $this->deleteUser();
            } elseif ( $op == 'show' ) {
                $this->showUser();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            $this->showError("Application error", $e->getMessage());
        }
    }

    public function listUsers(){
    	$orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
    	$users = $this->usersService->getAllUsers($orderby);
    	include 'view/users.php';
    }
    public function saveUser(){
   		$title = 'Add new user';
         
        $email = '';
        $first_name = '';
        $last_name = '';
        $password = '';
        
        $errors = array();
         
        if ( isset($_POST['form-submitted']) ) {
             
            $email       = isset($_POST['email']) ?   $_POST['email']  :NULL;
            $first_name      = isset($_POST['first_name'])?   $_POST['first_name'] :NULL;
            $last_name      = isset($_POST['last_name'])?   $_POST['last_name'] :NULL;
            $password    = isset($_POST['password'])? $_POST['password']:NULL;
             
            try {
                $this->usersService->createUser($email, $first_name, $last_name, $password);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        include 'view/user-form.php';	
    }

    public function deleteUser(){
    	$id=isset($_GET['id'])?$_GET['id']:NULL;
    	if(!$id){
    		throw new Exception('Internal Error');
    	}
    	$this->usersService->deleteUser($id);
    	$this->redirect('index.php');
    }

    public function editUser(){
    	$id = '';
    	$email = '';
        $first_name = '';
        $last_name = '';
        $password = '';

        $errors = array();
     
	    if ( isset($_POST['form-submitted']) ) {
	         
	        $id =isset($_POST['id']) ?   $_POST['id']  :NULL;
	        $email       = isset($_POST['email']) ?   $_POST['email']  :NULL;
	        $first_name      = isset($_POST['first_name'])?   $_POST['first_name'] :NULL;
	        $last_name      = isset($_POST['last_name'])?   $_POST['last_name'] :NULL;
	        $password    = isset($_POST['password'])? $_POST['password']:NULL;
	         
	        try {
	            $this->usersService->editUser($id, $email, $first_name, $last_name, $password);
	            $this->redirect('index.php');
	            return;
	        } catch (ValidationException $e) {
	            $errors = $e->getErrors();
	        }
	    }

    	$id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $user = $this->usersService->getUser($id);
         
        include 'view/edit-form.php';
    }


    public function showUser(){
    	$id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $user = $this->usersService->getUser($id);
         
        include 'view/user.php';
    }
    public function showError($title, $message) {
        include 'view/error.php';
    }




}