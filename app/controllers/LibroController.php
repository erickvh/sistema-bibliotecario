<?php

use App\Models\Libros;
use App\Models\Materialesbibliograficos;
use App\Models\Bibliotecarios;


class LibroController extends \Phalcon\Mvc\Controller
{
    public function consultarAction()
    {
        $idusuario = $this->session->get('id');
        $bibliotecario = Bibliotecarios::findFirst([
            'columns'    => 'idbiblioteca',
            'conditions' => 'iduser = ?1',
            'bind'       => [
                    1 => $idusuario,
                ]
        ]);


        $libros = Libros::find();

        /*$libros = $libros->filter(
            function ($libro) {
                if ($libro->Materialesbibliograficos->idbiblioteca == $bibliotecario->idbiblioteca) {
                    return $libro;
                }
            }
        );*/
        
        $this->view->pick('libro/consultar');
        $this->view->libros= $libros;
        $this->view->bib= $bibliotecario->idbiblioteca;

    }

}