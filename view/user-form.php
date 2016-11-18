<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php print htmlentities($title) ?>
        </title>
    </head>
    <body>
        <?php
        if ( $errors ) {
            print '<ul class="errors">';
            foreach ( $errors as $field => $error ) {
                print '<li>'.htmlentities($error).'</li>';
            }
            print '</ul>';
        }
        ?>
        <form method="POST" action="">
            <label for="email">Email:</label><br/>
            <input type="text" name="email" value="<?php print htmlentities($email) ?>"/>
            <br/>
             
            <label for="first_name">First Name:</label><br/>
            <input type="text" name="first_name" value="<?php print htmlentities($first_name) ?>"/>
            <br/>
            <label for="last_name">Last Name:</label><br/>
            <input type="text" name="last_name" value="<?php print htmlentities($last_name) ?>" />
            <br/>
            <label for="password">Password:</label><br/>
            <input type="password" name="password" value="<?php print htmlentities($password)?>" />
            <br/>
            <input type="hidden" name="form-submitted" value="1" />
            <input type="submit" value="Submit" />
        </form>
         
    </body>
</html>