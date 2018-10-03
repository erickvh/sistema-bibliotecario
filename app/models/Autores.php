<?php

namespace App\Models;

class Autores extends \Phalcon\Mvc\Model
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
    public $nacionalidad;

    /**
     *
     * @var string
     */
    public $fechanacimiento;

    /**
     *
     * @var string
     */
    public $sexo;

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
        $this->setSource("autores");
        $this->belongsTo('idmaterial', 'App\Models\Materialesbibliograficos', 'id', ['alias' => 'Materialesbibliograficos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'autores';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Autores[]|Autores|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Autores|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
