<?php

namespace App\Models;

class Subcategorias extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $nombre;

    /**
     *
     * @var string
     */
    public $descripcion;

    /**
     *
     * @var string
     */
    public $codigo;

    /**
     *
     * @var integer
     */
    public $idcategoria;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("subcategorias");
        $this->belongsTo('idcategoria', 'App\Models\Categorias', 'id', ['alias' => 'Categorias']);
        $this->belongsTo('idcategoria', 'App\Models\Materialesbibliograficos', 'id', ['alias' => 'Materialesbibliograficos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'subcategorias';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Subcategorias[]|Subcategorias|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Subcategorias|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
