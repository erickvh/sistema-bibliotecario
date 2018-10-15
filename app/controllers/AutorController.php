<?php

use App\Models\Autores;
use App\Models\Users;
use App\Validations\ValidacionAutor;

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
                $this->view->biblioteca=$this->biblioteca;
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
        if($this->biblioteca){
        $autores=Autores::find('idbiblioteca ='.$this->biblioteca->id);
         }
        $this->view->pick('autor/index');
    
        $this->view->autores=$autores;

    }

    public function storeAction(){
        $this->view->disable();

     
        $validacion= new ValidacionAutor;
        $mensajes=[];

        $messages = $validacion->validate($_POST); //recoge las variables globales post
        
        //captura mensajes que son al respecto de los campos encontrados
        foreach ($messages as  $m) 
        {
            $mensajes[$m->getField()]=$m->getMessage();
        }
        
        if(!empty($mensajes))
        {   
            $this->flashSession->error('No se ha actualizado autor, algunos errores en los campos mencionados');
            
            //hace el bucle media vez halla capturado validaciones
            foreach ($mensajes as $mensaje ) {
                $this->flashSession->warning($mensaje);                
                
            }

           //redirige al mismo formulario
            $this->response->redirect('/autor'.$id);
            
        }
        else
        {//VALIDACION CON EXITO
        $autor= new Autores;
        
        $nombre=$this->request->getPost('nombre');
        $nacionalidad=$this->request->getPost('nacionalidad');
        
        $fechanacimiento=$this->request->getPost('fechanacimiento');
//entra si no es null
        if($fechanacimiento)
        {
            $autor->fechanacimiento=$fechanacimiento;

        }
        $sexo=$this->request->getPost('sexo');

        $autor->nombre=$nombre;
        $autor->nacionalidad=$nacionalidad;
        $autor->sexo=$sexo;
        $autor->idbiblioteca=$this->user->bibliotecarios[0]->idbiblioteca;
        $autor->save();
        $this->flashSession->success('Autor guardado con exito');
        $this->response->redirect('/autor');
    }
}
    public function editAction(){

        $id=$this->dispatcher->getParam('id');
        $autor=Autores::findFirst($id);
        $this->view->pick('autor/editar');
        $this->view->autor=$autor;
    }

    public function updateAction(){
        $id=$this->dispatcher->getParam('id');

        $validacion= new ValidacionAutor;
        $mensajes=[];

        $messages = $validacion->validate($_POST); //recoge las variables globales post
        
        //captura mensajes que son al respecto de los campos encontrados
        foreach ($messages as  $m) 
        {
            $mensajes[$m->getField()]=$m->getMessage();
        }
        
        if(!empty($mensajes))
        {   
            $this->flashSession->error('No se ha actualizado autor, algunos errores en los campos mencionados');
            
            //hace el bucle media vez halla capturado validaciones
            foreach ($mensajes as $mensaje ) {
                $this->flashSession->warning($mensaje);                
                
            }

           //redirige al mismo formulario
            $this->response->redirect('/autor/editar/'.$id);
            
        }
        else
        {//VALIDACION CON EXITO

        //data from post
        
        $nombre=$this->request->getPost('nombre');
        $nacionalidad=$this->request->getPost('nacionalidad');
        $fechanacimiento=$this->request->getPost('fechanacimiento');
        $sexo=$this->request->getPost('sexo');
        
//entra si no es null
        if($fechanacimiento)
        {
            $autor->fechanacimiento=$fechanacimiento;

        }
        $autor=Autores::findFirst($id);
        $autor->nombre=$nombre;
        $autor->nacionalidad=$nacionalidad;
        $autor->sexo=$sexo;
        $autor->save();
        $this->flashSession->success('Autor Actualizado con exito');
        $this->response->redirect('/autor');
        }
    }

    public function showAction(){
        
        $id=$this->dispatcher->getParam('id');
        $autor=Autores::findFirst($id);
     
        $this->view->pick('autor/show');
        $this->view->autor=$autor;
    }

    public function deleteAction(){

        $this->view->pick('autor/eliminar');
        $id=$this->dispatcher->getParam('id');
        $autor=Autores::findFirst($id);     
        $this->view->autor=$autor;
        
        if($this->request->isPost()){
            if(isset($autor->materialesAutores[0]))
            {
                $this->flashSession->error('Autor no se ha eliminado, porque esta siendo utilizado en libros/recursos');
                $this->response->redirect("/autor");
            }
            else
            {
                $this->view->disable();
                $autor->delete();
                $this->flashSession->success('Autor se ha eliminado con exito');
                $this->response->redirect("/autor");
            }
            
            }
    }
}

