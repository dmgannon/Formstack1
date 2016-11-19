<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Users</title>
    </head>
    <body>
        <div><a href="index.php?op=new">Add New User</a></div>
        <br>
        <table border="0" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><b>Email</th>
                    <th><b>First Name</th>
                    <th><b>Last Name</th>
                    <th><b>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><a href="index.php?op=show&id=<?php print $user->id; ?>"><?php print htmlentities($user->email); ?></a></td>
                        <td><?php print htmlentities($user->first_name); ?></td>
                        <td><?php print htmlentities($user->last_name); ?></td>
                        <td><?php print htmlentities($user->password); ?></td>
                        <td><a href="index.php?op=delete&id=<?php print $user->id; ?>">delete</a> |</td>
                        <td><a href="index.php?op=edit&id=<?php print $user->id; ?>">edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>