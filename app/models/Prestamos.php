<?php

namespace App\Models;

class Prestamos extends \Phalcon\Mvc\Model
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
    public $fechaprestamo;

    /**
     *
     * @var string
     */
    public $fechadevolucion;

    /**
     *
     * @var string
     */
    public $devuelto;

    /**
     *
     * @var integer
     */
    public $diasatrasado;

    /**
     *
     * @var integer
     */
    public $idmaterial;

    /**
     *
     * @var integer
     */
    public $idprestamista;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("prestamos");
        $this->belongsTo('idmaterial', 'App\Models\Materialesbibliograficos', 'id', ['alias' => 'Materialesbibliograficos']);
        $this->belongsTo('idprestamista', 'App\Models\Prestamistas', 'id', ['alias' => 'Prestamistas']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'prestamos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Prestamos[]|Prestamos|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Prestamos|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
