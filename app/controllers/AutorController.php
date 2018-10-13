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
        
        if($this->session->has('id'))
        {  

            //crea la busqueda si existe id
        $this->idSesion = $this->session->get('id');
        $this->user=Users::findFirst($this->idSesion);
        $this->rol=$this->user->roles->nombre;

        // redirige si el rol cargado es diferente
            switch($this->rol){
                case 'Administrador': 
                case 'Prestamista':
                $this->response->redirect('/401');
                break;
                case 'Bibliotecario':
                $this->biblioteca=$this->user->bibliotecarios[0]->bibliotecas; 
                break;
                            }
        }
        else
        {
            $this->response->redirect('/401');
        }
  

    }
    
    public function indexAction()
    {
        if($biblioteca){
        $autores=Autores::find('idbiblioteca ='.$this->biblioteca->id);
         }
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

        $id=$this->dispatcher->getParam('id');
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
        $id=$this->dispatcher->getParam('id');

        $autor=Autores::findFirst($id);
        $autor->nombre=$nombre;
        $autor->nacionalidad=$nacionalidad;
        $autor->fechanacimiento=$fechanacimiento;
        $autor->sexo=$sexo;
        $autor->save();
        $this->dispatcher->forward(['action' => 'index']);
    }

    public function showAction(){
        
        $id=$this->dispatcher->getParam('id');
        $autor=Autores::findFirst($id);
     
        $this->view->pick('autor/show');
        $this->view->autor=$autor;
    }

    public function deleteAction(){

        $this->view->pick('/autor/eliminar');
        $id=$this->dispatcher->getParam('id');
        $autor=Autores::findFirst($id);     
        $this->view->autor=$autor;
        
        if($this->request->isPost()){

                $this->view->disable();
                $autor->delete();

                $this->response->redirect("/autor");
            
            }
    }
}

