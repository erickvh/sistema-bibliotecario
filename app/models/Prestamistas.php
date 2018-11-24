<?php

namespace App\Models;

class Prestamistas extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     *
     */
    public $lugardeestudio;

    /**
     *
     * @var string
     */
    public $trabaja;

    /**
     *
     * @var string
     */
    public $estudia;

    /**
     *
     * @var string
     */
    public $direccion;

    /**
     *
     * @var string
     */
    public $nombredepadre;

    /**
     *
     * @var string
     */
    public $nombredemadre;

    /**
     *
     * @var string
     */
    public $telefono;

    /**
     *
     * @var string
     */
    public $activo;

    /**
     *
     * @var integer
     */
    public $iduser;

    /**
     *
     * @var integer
     */
    public $idmunicipio;

    /**
     *
     * @var integer
     */
    public $idbibilioteca;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("prestamistas");
        $this->hasMany('id', 'App\Models\Prestamos', 'idprestamista', ['alias' => 'Prestamos']);
        $this->hasMany('id', 'App\Models\Reservas', 'idprestamista', ['alias' => 'Reservas']);
        $this->belongsTo('idbibilioteca', 'App\Models\Bibliotecas', 'id', ['alias' => 'Bibliotecas']);
        $this->belongsTo('idmunicipio', 'App\Models\Municipios', 'id', ['alias' => 'Municipios']);
        $this->belongsTo('iduser', 'App\Models\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'prestamistas';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Prestamistas[]|Prestamistas|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Prestamistas|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
