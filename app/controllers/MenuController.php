<?php

class MenuController extends \Phalcon\Mvc\Controller
{

    public function adminAction()
    {
        if($this->session->has('username'))
        $this->view->pick('layouts/admin');
        else
        $this->response->redirect('/');
    }

    public function bibliotecarioAction()
    {
        if($this->session->has('username'))
        $this->view->pick('layouts/bibliotecario');
        else
        $this->response->redirect('/');
    }

}

