<?php

namespace App\Models;

class Libros extends \Phalcon\Mvc\Model
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
    public $volumen;

    /**
     *
     * @var string
     */
    public $editorial;

    /**
     *
     * @var string
     */
    public $sinopsis;

    /**
     *
     * @var string
     */
    public $isbn;

    /**
     *
     * @var integer
     */
    public $idmaterial;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("libros");
        $this->belongsTo('idmaterial', 'App\Models\Materialesbibliograficos', 'id', ['alias' => 'Materialesbibliograficos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'libros';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Libros[]|Libros|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Libros|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
