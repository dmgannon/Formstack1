<?php

use Phinx\Migration\AbstractMigration;

class Migrate2Data extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        // Insert some data
        $rows = [
            [
              'email'    => "Danielle.Gannon@formstack.com",
              'first_name'  => 'Danielle',
              'last_name'  => 'Gannon',
              'password'  => 'Blah1234'
            ],
            [
              'email'    => "Max.Nierste@formstack.com",
              'first_name'  => 'Max',
              'last_name'  => 'Nierste',
              'password'  => 'MaxNie007'
            ],
            [
              'email'    => "Chris.Pierce@formstack.com",
              'first_name'  => 'Chris',
              'last_name'  => 'Pierce',
              'password'  => 'TheChris999'
            ]
        ];

       // $this->insert('users', $rows);
        $table = $this->table('users');
        $table->insert($rows);
        $table->saveData();

    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->execute('DELETE FROM users');
    }
}
