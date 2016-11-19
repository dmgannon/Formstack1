<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Edit User</title>
    </head>
    <body>
        <h3>Edit User: </h3>
        <h1><?php print $user->first_name; ?> <?php print $user->last_name; ?></h1>
        <form method="POST" action="">
            <label for="id">User id (read-only):</label><br/>
            <input type="text" name="id" value="<?php print htmlentities($user->id) ?>" readonly/>
            <br/>
            <label for="email">Email:</label><br/>
            <input type="text" name="email" value="<?php print htmlentities($user->email) ?>"/>
            <br/>
            <label for="first_name">First Name:</label><br/>
            <input type="text" name="first_name" value="<?php print htmlentities($user->first_name) ?>"/>
            <br/>
            <label for="last_name">Last Name:</label><br/>
            <input type="text" name="last_name" value="<?php print htmlentities($user->last_name) ?>" />
            <br/>
            <label for="password">Password:</label><br/>
            <input type="text" name="password" value="<?php print htmlentities($user->password)?>" />
            <br/>
            <input type="hidden" name="form-submitted" value="1" />
            <input type="submit" value="Submit" />
        </form>  
    </body>
</html>