<?php
use App\Models\Bibliotecas;
use Phalcon\Http\Response;
use App\Models\Users;
use App\Validations\ValidacionBiblioteca;
use App\Models\Bibliotecarios;
use App\Models\Prestamistas;
use  Carbon\Carbon;


class LectorController extends \Phalcon\Mvc\Controller
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
   $idusuario = $this->session->get('id');
   $prestamistas= Prestamistas::find('idbibilioteca ='.$this->biblioteca->id);

   $this->view->pick('lector/consultar');
   $this->view->prestamistas= $prestamistas;
  
    }

    public function crearAction() {
        $this->view->pick('lector/crear');
    }

}

