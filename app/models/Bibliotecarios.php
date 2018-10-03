<?php

namespace App\Models;

class Bibliotecarios extends \Phalcon\Mvc\Model
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
    public $dui;

    /**
     *
     * @var string
     */
    public $telefono;

    /**
     *
     * @var integer
     */
    public $iduser;

    /**
     *
     * @var integer
     */
    public $idbiblioteca;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("bibliotecarios");
        $this->belongsTo('idbiblioteca', 'App\Models\Bibliotecas', 'id', ['alias' => 'Bibliotecas']);
        $this->belongsTo('iduser', 'App\Models\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'bibliotecarios';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Bibliotecarios[]|Bibliotecarios|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Bibliotecarios|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
