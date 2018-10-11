<?php

use App\Models\Autores;
use App\Models\Users;

class AutorController extends \Phalcon\Mvc\Controller
{   
    protected $idSesion;
    protected $user;
    protected $rol;
    protected $biblioteca;

    //esta ruta se ejecuta antes de cada funcion en el controlador
    public function initialize()
    {
        
        $this->idSesion = $this->session->get('id');
        $this->user=Users::findFirst($this->idSesion);
        $this->rol=$this->user->roles->nombre;
        
        if(!$this->rol=='Bibliotecario'){
            $this->response->redirect('/401');
        }

  
    }
    
    public function indexAction()
    {

        $autores=Autores::find();
        
        $this->view->pick('autor/index');
        $this->view->autores=$autores;

    }

    public function storeAction(){
        $this->view->disable();
        $autor= new Autores;
        
        $nombre=$this->request->getPost('nombre');
        $nacionalidad=$this->request->getPost('nacionalidad');
        $fechanacimiento=$this->request->getPost('fechanacimiento');
        $sexo=$this->request->getPost('sexo');

        $autor->nombre=$nombre;
        $autor->nacionalidad=$nacionalidad;
        $autor->fechanacimiento=$fechanacimiento;
        $autor->sexo=$sexo;
        $autor->idbiblioteca=$this->user->bibliotecarios[0]->idbiblioteca;
        $autor->save();
        $this->response->redirect('/autor');
    }

    public function editAction(){

        $id=$this->dispatcher->getParam('int');
        $autor=Autores::findFirst($id);
        $this->view->pick('autor/editar');
        $this->view->autor=$autor;
    }

    public function updateAction(){
 
        //data from post
        $nombre=$this->request->getPost('nombre');
        $nacionalidad=$this->request->getPost('nacionalidad');
        $fechanacimiento=$this->request->getPost('fechanacimiento');
        $sexo=$this->request->getPost('sexo');
        $id=$this->dispatcher->getParam('int');

        $autor=Autores::findFirst($id);
        $autor->nombre=$nombre;
        $autor->nacionalidad=$nacionalidad;
        $autor->fechanacimiento=$fechanacimiento;
        $autor->sexo=$sexo;
        $autor->save();
        $this->dispatcher->forward(['action' => 'edit']);
    }

    public function showAction(){
        $id=$this->dispatcher->getParam('int');
        $autor=Autores::findFirst($id);
        $this->view->pick('autor/show');
        $this->view->autor=$autor;
    }

    public function deleteAction(){
        $this->view->disable();
        $id=$this->dispatcher->getParam('id');
        $autor=Autores::findFirst($id);
        $autor->delete();
        $this->response->redirect("/autor");

    }
}

