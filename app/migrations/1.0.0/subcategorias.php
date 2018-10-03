<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class SubcategoriasMigration_100
 */
class SubcategoriasMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('subcategorias', [
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
                            'size' => 50,
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
                        'codigo',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 8,
                            'after' => 'descripcion'
                        ]
                    ),
                    new Column(
                        'idcategoria',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'after' => 'codigo'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('pk_subcategorias', ['id'], null),
                    new Index('subcategorias_codigo_key', ['codigo'], null)
                ],
                'references' => [
                    new Reference(
                        'fk_subcategorias_categorias',
                        [
                            'referencedTable' => 'categorias',
                            'referencedSchema' => 'public',
                            'columns' => ['idcategoria'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'RESTRICT',
                            'onDelete' => 'RESTRICT'
                        ]
                    ),
                    new Reference(
                        'fk_subcategorias_materiales',
                        [
                            'referencedTable' => 'materialesbibliograficos',
                            'referencedSchema' => 'public',
                            'columns' => ['idcategoria'],
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
