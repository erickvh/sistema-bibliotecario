<?php


use App\Models\Users;

class IndexController extends ControllerBase
{

    //evitando duplicacion de sesiones
    public function indexAction()
    {   
        if(!$this->session->has('id')){
 
            $this->view->pick('login/login');                
        
        }
        else{
            $id=$this->session->get("id");
            $rol=Users::findFirst($id)->roles->nombre;
            switch($rol){ //si se solicita ruta raiz se redirecciona segun su rol
                case 'Administrador':
                    $this->response->redirect('/administrador');
                    break;
                case 'Bibliotecario':
                    $this->response->redirect('/bibliotecario');
                    break;
                case 'Prestamista': 
                    $this->response->redirect('/prestamista');
            }           
        }
    }

    public function loginAction(){
        $this->view->disable();

        $name=$this->request->getPost('username');
        $password=$this->request->getPost('password');
  

        $user=Users::findFirst("username='".$name."'");

        if($user){
            if($this->security->checkHash($password,$user->password)){
               // creando session id and username

                $this->session->set("id", $user->id);
                $this->session->set("username",$user->username);
         
                        if($user->roles->nombre=='Administrador')
                        {       
                            $this->flashSession->success('Bienvenido '.$user->username );
                            $this->response->redirect('/administrador');
                        }
                        elseif($user->roles->nombre=='Bibliotecario'){
                            $this->flashSession->success('Bienvenido '.$user->username);
                            $this->response->redirect('/bibliotecario');  
                        }     
                                
                                                                            }
                            else{ //ninguno de los casos
                            
                    return $this->response->redirect('/');
                                }

            }
            else{
                
             return $this->response->redirect('/');//solo usuario digitado
                }
}

public function logoutAction(){
    $this->session->destroy();
    $this->flashSession->success('Adios');
    $this->response->redirect('/');
}
}
