<?php

use App\Models\Users;

class MenuController extends \Phalcon\Mvc\Controller
{
    protected $idSesion;
    protected $user;
    protected $rol;
    
    public function initialize(){
        $this->idSesion = $this->session->get('id');
        $this->user=Users::findFirst($this->idSesion);
        $this->rol=$this->user->roles->nombre;

    }

    public function adminAction()
    {
        switch($this->rol){
            case 'Prestamista':
            case 'Bibliotecario': 
            $this->response->redirect('/401');
        }
        $this->view->pick('layouts/admin');
    }

    public function bibliotecarioAction()
    {
        switch($this->rol){
            case 'Prestamista':
            case 'Administrador': 
            $this->response->redirect('/401');
        }
        $this->view->pick('layouts/bibliotecario');
       
    }


}

