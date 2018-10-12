<?php
use App\Models\Bibliotecarios;
use App\Models\Users;
use Phalcon\Http\Response;
class PerfilController extends \Phalcon\Mvc\Controller
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
                case 'Administrador': 
                case 'Prestamista':
                $this->response->redirect('/401');
                break;
                case 'Bibliotecario':
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
    	$this->view->pick('perfil/perfil');
    	$idusuario = $this->session->get('id');
        $user = Users::findFirst($idusuario);
        $this->view->usuario = $user;
    }

    public function cambiarAction()
    {
    	$this->view->pick('perfil/cambiar');
    	$idusuario = $this->session->get('id');        
        $password = $this->request->getPost('conAnterior'); 
        $user = Users::findFirst($idusuario);
 		if($this->request->isPost())
 		{
 			if($this->security->checkHash($password,$user->password))
    		{
    			$nueva = $this->request->getPost('conNueva');
    			$user->password = $this->security->hash($nueva);
    			$user->save();
    			$response = new Response();
            	$response->redirect('/perfil'); 
            	return $response;   
    		}
    		else{
    			$response = new Response();
           		$response->redirect('/perfil'); 
            	return $response;   
    		}
 		}      	
    }

}

