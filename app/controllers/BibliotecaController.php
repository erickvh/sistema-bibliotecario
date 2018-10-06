<?php

use App\Models\Bibliotecas;

class BibliotecaController extends \Phalcon\Mvc\Controller
{
    public function consultarAction()
    {
        $bibliotecas=Bibliotecas::find();
        $this->view->pick('biblioteca/consultar');
        $this->view->bibliotecas= $bibliotecas;

    }

}