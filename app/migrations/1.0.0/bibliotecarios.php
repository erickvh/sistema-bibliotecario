<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class BibliotecariosMigration_100
 */
class BibliotecariosMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('bibliotecarios', [
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
                        'dui',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 9,
                            'after' => 'id'
                        ]
                    ),
                    new Column(
                        'telefono',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 9,
                            'after' => 'dui'
                        ]
                    ),
                    new Column(
                        'iduser',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'after' => 'telefono'
                        ]
                    ),
                    new Column(
                        'idbiblioteca',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'after' => 'iduser'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('pk_bibliotecarios', ['id'], null),
                    new Index('uniq_iduser', ['iduser'], null)
                ],
                'references' => [
                    new Reference(
                        'fk_bibliotecarios_bibliotecas',
                        [
                            'referencedTable' => 'bibliotecas',
                            'referencedSchema' => 'public',
                            'columns' => ['idbiblioteca'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'RESTRICT',
                            'onDelete' => 'RESTRICT'
                        ]
                    ),
                    new Reference(
                        'fk_bibliotecarios_users',
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
