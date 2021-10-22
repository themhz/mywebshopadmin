<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MyFirstMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
   
    /**
     * Migrate Up.
     */
    public function up()
    {
        $users = $this->table('users');
        $users->addColumn('email', 'string', ['limit' => 100])
              ->addColumn('password', 'string', ['limit' => 40])              
              ->addColumn('firstname', 'string', ['limit' => 30])
              ->addColumn('lastname', 'string', ['limit' => 30])
              ->addColumn('phone', 'string', ['limit' => 10])
              ->addColumn('address', 'string', ['limit' => 100])
              ->addColumn('city', 'string', ['limit' => 20])
              ->addColumn('zipcode', 'string', ['limit' => 10])
              ->addColumn('regdate', 'datetime')              
              ->addIndex(['phone', 'email'], ['unique' => true])
              ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
