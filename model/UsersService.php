<?php

require_once 'model/UsersGateway.php';
require_once 'model/ValidationException.php';

class UsersService{

	private $usersGateway = NULL;

	private function connectDb(){
		$connection = mysqli_connect("localhost", "my_app", "secret", "my_app");
		return $connection;
		//add warning for connection
	}
	private function closeDb($connection){
		$connection->close();
	}
	public function __construct(){
		$this->usersGateway = new UsersGateway();
	}
	public function getAllUsers($order){
		try{
			$conn = $this->connectDb();
			$results=$this->usersGateway->selectAll($conn);
			$this->closeDb($conn);
			return $results;
		}catch(Exception $e){
			$this->closeDb();
			throw $e;
		}
	}
	public function getUser($id){
		try {
            $conn = $this->connectDb();
            $results = $this->usersGateway->selectById($id, $conn);
            $this->closeDb($conn);
            return $results;
        } catch (Exception $e) {
            $this->closeDb($conn);
            throw $e;
        }
        return $this->usersGateway->find($id);
		
	}

	private function validateUserParams($email, $first_name, $last_name, $password){
		$errors = array();
		if(!isset($email)||empty($email)){
			$errors[]='Email is required';
		}
		if (empty($errors)){
			return;
		}
		throw new ValidationException($errors);
	}

	public function createUser($email, $first_name, $last_name, $password){
		try{
			$conn = $this->connectDb();
			$this->validateUserParams($email, $first_name, $last_name, $password);
			$results = $this->usersGateway->insert($email, $first_name, $last_name, $password, $conn);
			$this->closeDb($conn);
			return $results;
		}catch (Exception $e){
			$this->closeDb($conn);
			throw $e;
		}
	}
	public function editUser($id, $email, $first_name, $last_name, $password){
		try{
			$conn = $this->connectDb();
			$this->validateUserParams($email, $first_name, $last_name, $password);
			$results = $this->usersGateway->edit($id, $email, $first_name, $last_name, $password, $conn);
			$this->closeDb($conn);
		}catch (Exception $e){
			$this->closeDb($conn);
			throw $e;
		}

	}
	public function deleteUser($id){
		try{
			$conn = $this->connectDb();
			$results = $this->usersGateway->delete($id, $conn);
			$this->closeDb($conn);
		}catch (Exception $e){
			$this->closeDb($conn);
			throw $e;
		}
	}


}