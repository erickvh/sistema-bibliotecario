<?php


use App\Models\Users;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->pick('login/login');
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
                    $this->response->redirect('/administrador');

                elseif($user->roles->nombre=='Bibliotecario')
                    $this->response->redirect('/bibliotecario');   
                           
                                                                    }
                    else{ //ninguno de los casos

            return $this->response->redirect('/');
                        }

                 }else{

             return $this->response->redirect('/');//solo usuario digitado
    }
}

public function logoutAction(){
    $this->session->destroy();
    $this->flash->success('Adios');
    $this->response->redirect('/');
}
}
