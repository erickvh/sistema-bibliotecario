<?php
use App\Models\Bibliotecarios;
use App\Models\Users;
use Phalcon\Http\Response;
class PerfilController extends \Phalcon\Mvc\Controller
{
    protected $idSesion;
    protected $user;
    protected $rol;
    protected $biblioteca;
    //esta ruta se ejecuta antes de cada funcion en el controlador
    public function initialize()
    {
//        $this->view->disable();

        if($this->session->has('id'))
        {
            //crea la busqueda si existe id
        $this->idSesion = $this->session->get('id');
        $this->user=Users::findFirst($this->idSesion);
        $this->rol=$this->user->roles->nombre;
        
        // redirige si el rol cargado es diferente
            switch($this->rol){
                 case 'Prestamista':
                $this->biblioteca=$this->user->prestamistas[0]->bibliotecas;
                break;
                case 'Administrador':
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
    	$idusuario = $this->session->get('id');
        $user = Users::findFirst($idusuario);
        $this->view->usuario = $user;
    
        if($this->biblioteca)//perfil de biblioteca necesita esto para ser cargada las imagenes
        {
            $this->rol!='Prestamista'? $this->view->pick('perfil/perfil'):$this->view->pick('perfil/perfilPrestamista');

            $this->view->biblioteca=$this->biblioteca;
        }
        else
        {
            $this->view->pick('perfil/perfilAdmin');
        }
    }

    public function cambiarAction()
    {   
        if($this->biblioteca)
        {
        
        $this->rol!='Prestamista'? $this->view->pick('perfil/cambiar'):$this->view->pick('perfil/cambiarPrestamista');

        $this->view->biblioteca=$this->biblioteca;
        }
        else
        {
        $this->view->pick('perfil/cambiarAdmin');
        }

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
                $this->flashSession->success('Contraseña cambiada con exito');
            	$response->redirect('/perfil/cambiar'); 
            	return $response;   
    		}
    		else{
                $this->flashSession->error('Contraseña no coincide con el registro');
    			$response = new Response();
           		$response->redirect('/perfil/cambiar'); 
            	return $response;   
    		}
 		}      	
    }

}

