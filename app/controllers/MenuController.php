<?php

use App\Models\Users;

class MenuController extends \Phalcon\Mvc\Controller
{
    protected $idSesion;
    protected $user;
    protected $rol;
    protected $biblioteca;
    public function initialize(){
        /*comprueba id de sesion */
        if($this->session->has('id')) 
        {
            //existencia de sesion permite formatear rol
        $this->idSesion = $this->session->get('id');
        $this->user=Users::findFirst($this->idSesion);
        $this->rol=$this->user->roles->nombre;

        }
        else
        {
            $this->response->redirect('/401'); //redirige a 401 si no existe sesion
        }
 

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
            break;
            case 'Bibliotecario':
            $this->biblioteca=$this->user->bibliotecarios[0]->bibliotecas;
            break;
        }

        $this->view->pick('layouts/bibliotecario');
        $this->view->biblioteca=$this->biblioteca;
        
    }


}

