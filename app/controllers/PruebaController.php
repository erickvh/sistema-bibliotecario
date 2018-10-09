<?php

use App\Models\Users;
use App\Models\Bibliotecarios;

class PruebaController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->view->pick('error/error');

    }

}

