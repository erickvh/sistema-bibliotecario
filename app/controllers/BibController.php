<?php

use App\Models\Bibliotecarios;
use App\Models\Users;
use App\Models\Bibliotecas;
use App\Validations\ValidacionBibliotecario;

class BibController extends \Phalcon\Mvc\Controller
{
    protected $idSesion;
    protected $user;
    protected $rol;

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
                case 'Bibliotecario': 
                case 'Prestamista':
                $this->response->redirect('/401');
                break;
                case 'Administrador':
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
        $bibliotecarios=Bibliotecarios::find();
        $this->view->pick('bibliotecarios/index');
        $this->view->bibliotecarios=$bibliotecarios;
 
    }

    public function storeAction()
    {
        $this->view->disable();
        //validaciones correspondientes
        $validacion= new ValidacionBibliotecario;
        $mensajes=[];

        $messages = $validacion->validate($_POST); //recoge las variables globales post
        
        //captura mensajes que son al respecto de los campos encontrados
        foreach ($messages as  $m) 
        {
            $mensajes[$m->getField()]=$m->getMessage();
        }
        
        if(!empty($mensajes))
        {   
            $this->flashSession->error('No se ha guardado bibliotecario, algunos errores en los campos mencionados');
            
            //hace el bucle media vez halla capturado validaciones
            foreach ($mensajes as $mensaje ) {
                $this->flashSession->warning($mensaje);                
                
            }

           //redirige al mismo formulario
            $this->response->redirect('/bibliotecarios/crear');
            
        }
        else
        {//VALIDACION CON EXITO

        
        $user= new Users();
        $bibliotecario= new Bibliotecarios();
        /*requiriendo todos los parametros */
        $username=$this->request->getPost('username');
        $password=$this->generatePassword();
        $email=$this->request->getPost('email');
        $fechanacimiento=$this->request->getPost('fechanacimiento');
        $nombre=$this->request->getPost('nombre');
        $sexo=$this->request->getPost('sexo');
        $idrol=2;

        $dui=$this->request->getPost('dui');
        $telefono=$this->request->getPost('telefono');
        $bibliotecaid=$this->request->getPost('biblioteca');
        
        $user->username=$username;
        $user->password=$this->security->hash($password);
        if($email)
        {
            $user->email=$email;
        }   
        $user->fechanacimiento=$fechanacimiento;
        $user->nombre=$nombre;
        $user->sexo=$sexo;
        $user->idrol=$idrol;
        $user->save();

        $bibliotecario->dui=$dui;
        $bibliotecario->telefono=$telefono;
        $bibliotecario->iduser=$user->id;
        $bibliotecario->idbiblioteca=$bibliotecaid;
        $bibliotecario->save();
        
        $this->flashSession->success('Bibliotecario almacenado corectamente! Contraseña temporal: '.$password);
        $this->response->redirect('bibliotecarios');
        }
    }

    //generador de password
    private function generatePassword(){

        $cadena =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $cadena .= '0123456789' ;
        $password = '';
        $limite = strlen($cadena) - 1;
 
        for ($i=0; $i < 5; $i++)
        $password .= $cadena[rand(0, $limite)];
        return $password;
    }
    public function mostrarPasswordAction(){

    }
    public function editAction(){

        $id=$this->dispatcher->getParam('id');
        $bibliotecario= Bibliotecarios::findFirst($id);
        $bibliotecas= Bibliotecas::find();
        $this->view->pick('bibliotecarios/editar');
        $this->view->bibliotecario=$bibliotecario;
        $this->view->bibliotecas=$bibliotecas;
        
    }
    public function updateAction(){
        $this->view->disable();    
        $id=$this->dispatcher->getParam('id');
        
        $bibliotecario= Bibliotecarios::findFirst($id);
               //validaciones correspondientes
               $validacion= new ValidacionBibliotecario;
               $mensajes=[];
       
               $messages = $validacion->validate($_POST); //recoge las variables globales post
               
               //captura mensajes que son al respecto de los campos encontrados
               foreach ($messages as  $m) 
               {
                   $mensajes[$m->getField()]=$m->getMessage();
               }
               
               if(!empty($mensajes))
               {   
                   $this->flashSession->error('No se ha actualizado bibliotecario, algunos errores en los campos mencionados');
                   
                   //hace el bucle media vez halla capturado validaciones
                   foreach ($mensajes as $mensaje ) {
                       $this->flashSession->warning($mensaje);                
                       
                   }
       
                  //redirige al mismo formulario
                   $this->response->redirect('/bibliotecarios/editar/'.$id);
                   
               }
               else
               {//VALIDACION CON EXITO
       
        /*requiriendo todos los parametros */
        $username=$this->request->getPost('username');
        $email=$this->request->getPost('email');
        $fechanacimiento=$this->request->getPost('fechanacimiento');
        $nombre=$this->request->getPost('nombre');
        $sexo=$this->request->getPost('sexo');

        $dui=$this->request->getPost('dui');
        $telefono=$this->request->getPost('telefono');
        $bibliotecaid=$this->request->getPost('biblioteca');
        
        
        $bibliotecario->dui=$dui;
        $bibliotecario->telefono=$telefono;
        $bibliotecario->idbiblioteca=$bibliotecaid;

        $bibliotecario->users->username=$username;
        $bibliotecario->users->email=$email;
        $bibliotecario->users->fechanacimiento=$fechanacimiento;
        $bibliotecario->users->nombre=$nombre;
        $bibliotecario->users->sexo=$sexo;


        $bibliotecario->save();
        $this->flashSession->success('Bibliotecario actualizado con exito');
        $this->response->redirect('bibliotecarios');
            }
    }

    public function showAction(){
            $id=$this->dispatcher->getParam('id');
 
            $bibliotecario=Bibliotecarios::findFirst($id);
            $this->view->pick("bibliotecarios/show");
            $this->view->bibliotecario=$bibliotecario;

    }

    public function deshabilitarAction(){


        $id=$this->dispatcher->getParam('id');
        $bibliotecario=Bibliotecarios::findFirst($id);
        $this->view->pick('bibliotecarios/deshabilitar');
        $this->view->bibliotecario=$bibliotecario;
        if($this->request->isPost()){

            $bibliotecario->habilitado=$bibliotecario->habilitado? false:true;
            $bibliotecario->save();
            $this->response->redirect('bibliotecarios');

        }
    }

    public function createAction(){
        $bibliotecas=Bibliotecas::find();
        $this->view->pick('bibliotecarios/create');
        $this->view->bibliotecas=$bibliotecas;
    }
}

