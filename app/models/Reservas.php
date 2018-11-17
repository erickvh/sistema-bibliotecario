<?php

namespace App\Models;

class Reservas extends \Phalcon\Mvc\Model
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
    public $fechareserva;

    /**
     *
     * @var string
     */
    public $fechasolicitud;

    /**
     *
     * @var string
     */
    public $prestado;

    /**
     *
     * @var string
     */
    public $cancelado;

    /**
     *
     * @var integer
     */
    public $idprestamista;

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
        $this->setSource("reservas");
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
        return 'reservas';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Reservas[]|Reservas|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Reservas|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
