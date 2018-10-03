<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UsersRolesMigration_100
 */
class UsersRolesMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('users_roles', [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'iduser',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'after' => 'id'
                        ]
                    ),
                    new Column(
                        'idrol',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'after' => 'iduser'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('pk_users_roles', ['id'], null)
                ],
                'references' => [
                    new Reference(
                        'fk_users_roles_roles',
                        [
                            'referencedTable' => 'roles',
                            'referencedSchema' => 'public',
                            'columns' => ['idrol'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'RESTRICT',
                            'onDelete' => 'RESTRICT'
                        ]
                    ),
                    new Reference(
                        'fk_users_roles_users',
                        [
                            'referencedTable' => 'users',
                            'referencedSchema' => 'public',
                            'columns' => ['iduser'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'RESTRICT',
                            'onDelete' => 'RESTRICT'
                        ]
                    )
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
