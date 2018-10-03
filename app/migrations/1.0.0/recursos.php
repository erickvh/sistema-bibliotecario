<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class RecursosMigration_100
 */
class RecursosMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('recursos', [
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
                        'idformato',
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
                            'after' => 'idformato'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('pk_recursos', ['id'], null),
                    new Index('uniqidmaterial', ['idmaterial'], null)
                ],
                'references' => [
                    new Reference(
                        'fk_recursos_formatos',
                        [
                            'referencedTable' => 'formatos',
                            'referencedSchema' => 'public',
                            'columns' => ['idformato'],
                            'referencedColumns' => ['id'],
                            'onUpdate' => 'RESTRICT',
                            'onDelete' => 'RESTRICT'
                        ]
                    ),
                    new Reference(
                        'fk_recursos_materiales',
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
