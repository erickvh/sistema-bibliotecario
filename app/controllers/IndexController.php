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
        $response= new Response();
        $name=$this->request->getPost('username');
        $password=$this->request->getPost('password');
  

        $user=Users::findFirst("username='".$name."'");
        $user->password=$this->security->hash($user->password);
        if($user){
            if($this->security->checkHash($password,$user->password)){
                $this->session->set("id", $user->id);
                $this->session->set("username",$user->username);



                var_dump('exito');
            }

        }

        var_dump($password);
        var_dump($user->password);
    }
}

