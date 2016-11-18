<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>User Data</title>
    </head>
    <body>
        <h1><?php print $user->first_name; ?> <?php print $user->last_name; ?></h1>
        <div>
            <span class="label">Email:</span>
            <?php print $user->email; ?>
        </div>
        <div>
            <span class="label">Password:</span>
            <?php print $user->password; ?>
        </div>
    </body>
</html>