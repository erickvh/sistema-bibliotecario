<?php

class ErrorController extends \Phalcon\Mvc\Controller
{
    public  function mostrar404Action(){
        $this->view->pick('error/404');
    }

    public  function mostrar500Action(){
        $this->view->pick('error/500');
    }

    public function mostrar401action(){
        $this->view->pick('error/401');
    }
}

