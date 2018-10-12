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


        $name=$this->request->getPost('username');
        $password=$this->request->getPost('password');
  

        $user=Users::findFirst("username='".$name."'");

        if($user){
            if($this->security->checkHash($password,$user->password)){
               // creando session id and username

                        /**
                         * Se crea session media vez cumpla los parametros
                         */
                        if($user->roles->nombre=='Administrador')
                        {     
                            $this->session->set("id", $user->id);
                            $this->session->set("username",$user->username);              
                            $this->flashSession->success('Bienvenido '.$user->nombre );
                            $this->response->redirect('/administrador');
                        }
                        /**
                         * Restriccion cuando son deshabilitados
                         */
                        elseif($user->roles->nombre=='Bibliotecario' && $user->bibliotecarios[0]->habilitado
                        &&$user->bibliotecarios[0]->bibliotecas->habilitado){

                            $this->session->set("id", $user->id);
                            $this->session->set("username",$user->username);
                            $this->flashSession->success('Bienvenido '.$user->nombre );
                            $this->response->redirect('/bibliotecario');  
                        } 
                        /**
                         * Cuando el usuario si esta deshabilitado
                         */
                        else{
                            /**
                             * concatena posiblidades de deshabilitacion
                             */
                            $userNot='Usuario '.$user->nombre.' deshabilitado';
                            $biblioNot='Biblioteca "'.$user->bibliotecarios[0]->bibliotecas->nombre.'" deshabilitada';

                            $this->flashSession->error($user->bibliotecarios[0]->bibliotecas->habilitado? $userNot:$biblioNot );
                            $this->response->redirect('/');
                        }    
                                
            }  

            /**
             * Contraseña no comparada igual
             */
                            else{ 
                                $this->flashSession->warning('Contraseña incorrecta!' );
                                return $this->response->redirect('/');
                                }

            }
            /**usuario no encontrado atravez del find */
            else{
             $this->flashSession->error('Usuario no encontrado en nuestros registros' );
             return $this->response->redirect('/');//solo usuario digitado
                }
}

public function logoutAction(){
    $this->flashSession->success('Adios, hasta luego');
    $this->session->destroy();
    $this->response->redirect('/');
}
}
