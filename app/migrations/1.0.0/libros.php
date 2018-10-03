<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class LibrosMigration_100
 */
class LibrosMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('libros', [
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
                        'volumen',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 20,
                            'after' => 'id'
                        ]
                    ),
                    new Column(
                        'editorial',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 120,
                            'after' => 'volumen'
                        ]
                    ),
                    new Column(
                        'sinopsis',
                        [
                            'type' => Column::TYPE_TEXT,
                            'size' => 1,
                            'after' => 'editorial'
                        ]
                    ),
                    new Column(
                        'idmaterial',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'after' => 'sinopsis'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('pk_libros', ['id'], null),
                    new Index('uniqidmateriales', ['idmaterial'], null)
                ],
                'references' => [
                    new Reference(
                        'fk_libros_materiales',
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
