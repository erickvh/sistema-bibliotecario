<?php

use App\Models\Users;
use App\Models\Bibliotecarios;
use App\Models\Materialesbibliograficos;

class PruebaController extends \Phalcon\Mvc\Controller
{
public $biblioteca=1;
    public function indexAction()
    {
        $sql="select *from materialesbibliograficos inner join subcategorias on materialesbibliograficos.idsubcategoria=subcategorias.id 
        inner join categorias on categorias.id=subcategorias.idcategoria  where categorias.idbiblioteca=".$this->biblioteca;
        $db = \Phalcon\Di::getDefault()->get('db');
        $datos = $db->fetchAll($sql);        
        var_dump($datos);
    }

}

