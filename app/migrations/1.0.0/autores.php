<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class AutoresMigration_100
 */
class AutoresMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('autores', [
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
                        'nombre',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 120,
                            'after' => 'id'
                        ]
                    ),
                    new Column(
                        'nacionalidad',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 50,
                            'after' => 'nombre'
                        ]
                    ),
                    new Column(
                        'fechanacimiento',
                        [
                            'type' => Column::TYPE_DATE,
                            'size' => 1,
                            'after' => 'nacionalidad'
                        ]
                    ),
                    new Column(
                        'sexo',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'fechanacimiento'
                        ]
                    ),
                    new Column(
                        'idmaterial',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'after' => 'sexo'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('pk_autores', ['id'], null)
                ],
                'references' => [
                    new Reference(
                        'fk_autores_material',
                        [
                            'referencedTable' => 'materialesbibliograficos',
                            'referencedSchema' => 'public',
                            'columns' => ['idmaterial'],
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
