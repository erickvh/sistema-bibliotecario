<?php

use App\Models\Autores;
use App\Models\Users;

class AutorController extends \Phalcon\Mvc\Controller
{   
    protected $idSesion;
    protected $biblioteca;
    protected $user;

    //esta ruta se ejecuta antes de cada funcion en el controlador
    public function initialize()
    {
        
        $this->idSesion = $this->session->get('id');
        $this->user=Users::findFirst($this->idSesion);
        
        if($this->user->roles->nombre=='Bibliotecario'){

            $this->biblioteca=$this->user->bibliotecarios->bibliotecas;
        }
        else{   
                $this->response->redirect('/401');
            }
  
    }
    
    public function indexAction()
    {

        $autores=Autores::find();
        var_dump($autores);
        $this->view->pick('autor/index');
        $this->view->autores=$autores;
        $this->view->prueba='12';
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
        $autor->save();
        $this->response->redirect('/autor');
    }

    public function editAction(){

        $id=$this->dispatcher->getParam('id');
        $autor=Autores::findFirst($id);
        var_dump($this->session->get('id'));
        $this->view->pick('autor/editar');
        $this->view->autor=$autor;
    }

    public function updateAction(){
        

    }

    public function deleteAction(){
        $this->view->disable();
        $id=$this->dispatcher->getParam('id');
        $autor=Autores::findFirst($id);
        $autor->delete();
        $this->response->redirect("/autor");

    }
}

