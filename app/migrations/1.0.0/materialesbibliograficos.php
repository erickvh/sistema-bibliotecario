<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class MaterialesbibliograficosMigration_100
 */
class MaterialesbibliograficosMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('materialesbibliograficos', [
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
                        'descripcion',
                        [
                            'type' => Column::TYPE_TEXT,
                            'size' => 1,
                            'after' => 'nombre'
                        ]
                    ),
                    new Column(
                        'imagenurl',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 254,
                            'after' => 'descripcion'
                        ]
                    ),
                    new Column(
                        'nombreimagen',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 50,
                            'after' => 'imagenurl'
                        ]
                    ),
                    new Column(
                        'fechapublicacion',
                        [
                            'type' => Column::TYPE_DATE,
                            'size' => 1,
                            'after' => 'nombreimagen'
                        ]
                    ),
                    new Column(
                        'esexterno',
                        [
                            'type' => Column::TYPE_BOOLEAN,
                            'notNull' => true,
                            'after' => 'fechapublicacion'
                        ]
                    ),
                    new Column(
                        'idbiblioteca',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'after' => 'esexterno'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('pk_materiales', ['id'], null)
                ],
                'references' => [
                    new Reference(
                        'fk_materiales_bibliotecas',
                        [
                            'referencedTable' => 'bibliotecas',
                            'referencedSchema' => 'public',
                            'columns' => ['idbiblioteca'],
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
