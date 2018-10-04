<?php

namespace App\Models;

class Materialesbibliograficos extends \Phalcon\Mvc\Model
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
    public $imagenurl;

    /**
     *
     * @var string
     */
    public $nombreimagen;

    /**
     *
     * @var string
     */
    public $fechapublicacion;

    /**
     *
     * @var string
     */
    public $esexterno;

    /**
     *
     * @var integer
     */
    public $idbiblioteca;

    /**
     *
     * @var integer
     */
    public $idsubcategoria;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("materialesbibliograficos");
        $this->hasMany('id', 'App\Models\Libros', 'idmaterial', ['alias' => 'Libros']);
        $this->hasMany('id', 'App\Models\MaterialesAutores', 'idmaterial', ['alias' => 'MaterialesAutores']);
        $this->hasMany('id', 'App\Models\Recursos', 'idmaterial', ['alias' => 'Recursos']);
        $this->hasMany('id', 'App\Models\Unidades', 'idmaterial', ['alias' => 'Unidades']);
        $this->belongsTo('idbiblioteca', 'App\Models\Bibliotecas', 'id', ['alias' => 'Bibliotecas']);
        $this->belongsTo('idsubcategoria', 'App\Models\Subcategorias', 'id', ['alias' => 'Subcategorias']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'materialesbibliograficos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Materialesbibliograficos[]|Materialesbibliograficos|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Materialesbibliograficos|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
