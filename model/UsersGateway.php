<?php

require_once 'model/UsersService.php';

class UsersGateway
{     
    /**
    * Function that selects all the users.
    *
    * Selects all the user data from the db
    * to be sent back as $users array
    */
    public function selectAll($connection)
    {
        $dbres = mysqli_query($connection, "SELECT * FROM users"); 
        $users = array();
        while (($obj = mysqli_fetch_object($dbres)) != NULL)
        {
            $users[] = $obj;
        }
        return $users;
    }
     
    /**
    * Function that selects a specific user.
    *
    * Selects all the user data from the db
    * from a specific user by user id.
    */
    public function selectById($id, $conn)
    {
        $dbId = mysqli_real_escape_string($conn, $id);

        if (!mysqli_query($conn, "SELECT * FROM users WHERE id=$dbId"))
        {
            printf("Errormessage: %s\n", mysqli_error($conn));
        }else
        {
            $dbres = mysqli_query($conn,"SELECT * FROM users WHERE id=$dbId");
        }

        return mysqli_fetch_object($dbres);
    }
     
    /**
    * Function that inserts a user to the db.
    *
    * Receives the email, first name, last name, and password
    * that is required to be entered in the db.
    * All saved a strings and checked if null.
    */
    public function insert($email, $first_name, $last_name, $password, $conn)
    {
        $emailString = mysqli_real_escape_string($conn, $email);
        $firstString = mysqli_real_escape_string($conn, $first_name);
        $lastString = mysqli_real_escape_string($conn, $last_name);
        $passString = mysqli_real_escape_string($conn, $password);
         
        $dbEmail = ($email != NULL)?"'".$emailString."'":'NULL';
        $dbFirst = ($first_name != NULL)?"'".$firstString."'":'NULL';
        $dbLast = ($last_name != NULL)?"'".$lastString."'":'NULL';
        $dbPassword = ($password != NULL)?"'".$passString."'":'NULL';

        if (!mysqli_query($conn, "INSERT INTO users (email, first_name, last_name, password) VALUES ($dbEmail, $dbFirst, $dbLast, $dbPassword)"))
        {
            printf("Errormessage: %s\n", mysqli_error($conn));
        }

        return mysqli_insert_id($conn);
    }
     
    /**
    * Function that deletes a specific user.
    *
    * Deletes a specific user from the db
    * by the selected user id.
    */
    public function delete($id, $conn)
    {
        $dbId = mysqli_real_escape_string($conn, $id);
        if (!mysqli_query($conn, "DELETE FROM users WHERE id=$dbId"))
        {
            printf("Errormessage: %s\n", mysqli_error($conn));
        }
    }

    /**
    * Function that edits a specific user.
    *
    * Receives the data required to edit a specific user.
    * Updates the database after checking the data strings.
    */
    public function edit($id, $email, $first_name, $last_name, $password, $conn)
    {
        $dbId = mysqli_real_escape_string($conn, $id);
        $emailString = mysqli_real_escape_string($conn, $email);
        $firstString = mysqli_real_escape_string($conn, $first_name);
        $lastString = mysqli_real_escape_string($conn, $last_name);
        $passString = mysqli_real_escape_string($conn, $password);
         
        $dbEmail = ($email != NULL)?"'".$emailString."'":'NULL';
        $dbFirst = ($first_name != NULL)?"'".$firstString."'":'NULL';
        $dbLast = ($last_name != NULL)?"'".$lastString."'":'NULL';
        $dbPassword = ($password != NULL)?"'".$passString."'":'NULL';

        if (!mysqli_query($conn, "UPDATE users SET email=$dbEmail, first_name=$dbFirst, last_name=$dbLast, password=$dbPassword WHERE id=$dbId"))
        {
            printf("Errormessage: %s\n", mysqli_error($conn));
        }
        return mysqli_insert_id($conn);
    }
}
 
?>