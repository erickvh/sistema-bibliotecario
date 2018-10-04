<?php

use App\Models\Users;
use App\Models\Bibliotecarios;

class PruebaController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        var_dump(Bibliotecarios::findFirst(1)->bibliotecas->nombre);
    }

}

