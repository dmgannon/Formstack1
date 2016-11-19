<?php

use Phinx\Migration\AbstractMigration;

class Migrate1Table extends AbstractMigration
{
    /**
    * Creates the able in the database
    */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('email', 'string', array('limit' => 100))
              ->addColumn('first_name', 'string', array('limit' => 30))
              ->addColumn('last_name', 'string', array('limit' => 30))
              ->addColumn('password', 'string', array('limit' => 40))
              ->create();
    }
}