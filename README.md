# Formstack Project

During the vagrant set up, I had problems with provisioning. There is a known ssh-agent problem in Windows. This link https://github.com/mitchellh/vagrant/issues/1735 helped me.

After 'vagrant up', I did these commands:
$ eval `ssh-agent`

$ ssh-add

$ ssh-add -l

$ ssh vagrant

This allowed me to login to the server and copy the provisioning part in the Vagrantfile you supported.

Phinx Migration is supplied under the db/ folder. Running 'sudo php /usr/local/bin/vendor/bin/phinx migrate -e development' in the root folder will migrate all the databases. This contains database my_app, username my_app and password secret. It also will place some dummy data into the databases to show on testbox.dev.

MCV Folders:
controller/ : contains UsersController.php
model/ : contains UsersGateway.php, UsersService.php, ValidationException.php
view/ : contains edit-form.php, error.php, user-form.php, user.php, users.php

Also includes index.php file, phinx.yml, and the Vagrantfile.

Docblocks in the php files explain what each process does.
When testbox.dev is loaded, a Users page will appear.
Click each user to view user details.
Click Add New User to add a user.
Click Delete to delete a user.
Click Edit to edit a user.


