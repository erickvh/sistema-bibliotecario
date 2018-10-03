<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class BibliotecasMigration_100
 */
class BibliotecasMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('bibliotecas', [
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
                        'ubicacion',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 300,
                            'after' => 'nombre'
                        ]
                    ),
                    new Column(
                        'telefono',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 9,
                            'after' => 'ubicacion'
                        ]
                    ),
                    new Column(
                        'clasificacion',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 120,
                            'after' => 'telefono'
                        ]
                    ),
                    new Column(
                        'logourl',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 254,
                            'after' => 'clasificacion'
                        ]
                    ),
                    new Column(
                        'nombrelogo',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 50,
                            'after' => 'logourl'
                        ]
                    ),
                    new Column(
                        'email',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 254,
                            'after' => 'nombrelogo'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('bibliotecas_email_key', ['email'], null),
                    new Index('pk_bibliotecas', ['id'], null)
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
