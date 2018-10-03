<?php

namespace App\Models;

class Recursos extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $idformato;

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
        $this->setSource("recursos");
        $this->belongsTo('idformato', 'App\Models\Formatos', 'id', ['alias' => 'Formatos']);
        $this->belongsTo('idmaterial', 'App\Models\Materialesbibliograficos', 'id', ['alias' => 'Materialesbibliograficos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'recursos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Recursos[]|Recursos|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Recursos|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
