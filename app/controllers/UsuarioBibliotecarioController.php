<?php

use App\Models\Bibliotecarios;
use App\Models\Users;
use App\Models\Bibliotecas;

class UsuarioBibliotecarioController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {   
        $bibliotecarios=Bibliotecarios::find();
        $this->view->pick('bibliotecarios/index');
        $this->view->bibliotecarios=$bibliotecarios;
 
    }

    public function storeAction()
    {

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
        $user->email=$email;
        $user->fechanacimiento=$fechanacimiento;
        $user->nombre=$nombre;
        $user->sexo=$sexo;
        $user->idrol=$idrol;


        $bibliotecario->dui=$dui;
        $bibliotecario->telefono=$telefono;
        $bibliotecario->iduser=$user->id;
        $bibliotecario->idbiblioteca=$bibliotecaid;
        $bibliotecario->save();
        $this->response->redirect('bibliotecarios');
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
        $this->response->redirect('bibliotecarios');
        
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

