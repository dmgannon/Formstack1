<?php

require_once 'model/UsersService.php';

class UsersGateway {
     
    //this function is done and working
    public function selectAll($connection) {
        $dbres = mysqli_query($connection, "SELECT * FROM users"); 
        $users = array();
        while ( ($obj = mysqli_fetch_object($dbres)) != NULL ) {
            $users[] = $obj;
        }
         
        return $users;
    }
     
    //this function is done and working
    public function selectById($id, $conn) {
        $dbId = mysqli_real_escape_string($conn, $id);

        if (!mysqli_query($conn, "SELECT * FROM users WHERE id=$dbId")) {
            printf("Errormessage: %s\n", mysqli_error($conn));
        }else{
            $dbres = mysqli_query($conn,"SELECT * FROM users WHERE id=$dbId");
        }

        return mysqli_fetch_object($dbres);
    }
     
    //this function is done and complete
    public function insert($email, $first_name, $last_name, $password, $conn) {
        $emailString = mysqli_real_escape_string($conn, $email);
        $firstString = mysqli_real_escape_string($conn, $first_name);
        $lastString = mysqli_real_escape_string($conn, $last_name);
        $passString = mysqli_real_escape_string($conn, $password);
         
        $dbEmail = ($email != NULL)?"'".$emailString."'":'NULL';
        $dbFirst = ($first_name != NULL)?"'".$firstString."'":'NULL';
        $dbLast = ($last_name != NULL)?"'".$lastString."'":'NULL';
        $dbPassword = ($password != NULL)?"'".$passString."'":'NULL';

        if (!mysqli_query($conn, "INSERT INTO users (email, first_name, last_name, password) VALUES ($dbEmail, $dbFirst, $dbLast, $dbPassword)")) {
            printf("Errormessage: %s\n", mysqli_error($conn));
        }

        return mysqli_insert_id($conn);
    }
     
    //this function is complete and working
    public function delete($id, $conn) {
        $dbId = mysqli_real_escape_string($conn, $id);
        if (!mysqli_query($conn, "DELETE FROM users WHERE id=$dbId")) {
            printf("Errormessage: %s\n", mysqli_error($conn));
        }
    }

    //this function is complete and working
    public function edit($id, $email, $first_name, $last_name, $password, $conn) {
        $dbId = mysqli_real_escape_string($conn, $id);
        $emailString = mysqli_real_escape_string($conn, $email);
        $firstString = mysqli_real_escape_string($conn, $first_name);
        $lastString = mysqli_real_escape_string($conn, $last_name);
        $passString = mysqli_real_escape_string($conn, $password);
         
        $dbEmail = ($email != NULL)?"'".$emailString."'":'NULL';
        $dbFirst = ($first_name != NULL)?"'".$firstString."'":'NULL';
        $dbLast = ($last_name != NULL)?"'".$lastString."'":'NULL';
        $dbPassword = ($password != NULL)?"'".$passString."'":'NULL';

        if (!mysqli_query($conn, "UPDATE users SET email=$dbEmail, first_name=$dbFirst, last_name=$dbLast, password=$dbPassword WHERE id=$dbId")) {
            printf("Errormessage: %s\n", mysqli_error($conn));
        }
        return mysqli_insert_id($conn);
    }
     
}
 
?>