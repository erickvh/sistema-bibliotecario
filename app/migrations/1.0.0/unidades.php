<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UnidadesMigration_100
 */
class UnidadesMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('unidades', [
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
                        'unidadesexistentes',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'after' => 'id'
                        ]
                    ),
                    new Column(
                        'idmaterial',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'after' => 'unidadesexistentes'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('pk_unidades', ['id'], null),
                    new Index('uniq_idmaterial', ['idmaterial'], null)
                ],
                'references' => [
                    new Reference(
                        'fk_unidades_materiales',
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
