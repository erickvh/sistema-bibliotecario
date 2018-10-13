<?php
use App\Models\Formatos;
use Phalcon\Http\Response;
use App\Models\Users;
class FormatoController extends \Phalcon\Mvc\Controller
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
        $this->view->pick('formato/formato');
        $formatos = Formatos::find();
        $this->view->setVar('formato', $formatos); 
        $this->view->setVar('error', false);
        if ($this->request->isPost()) {
            $formato = new Formatos;
            $tipo = $this->request->getPost('tipoFormato');
            $desc = $this->request->getPost('descFormato');
            if($tipo){
                $formato->tipoformato = $tipo;
                $formato->descripcion = $desc;
                $formato->save();
                $response = new Response();
                $response->redirect('/formato'); //Retornar al index formato
                return $response;
            }
            else{
                $this->view->setVar('error', true); 
            }
        }
    }

    public function editarAction()
    {
        $this->view->pick('formato/editar');
        $id = $this->dispatcher->getParams(); //Obtener el parametros de la Url
        $formato = Formatos::findFirst($id);
        $this->view->formato = $formato;
        if ($this->request->isPost()) {
            // Accedemos a los datos POST            
            $tipo = $this->request->getPost('tipoFormato');
            $desc = $this->request->getPost('descFormato');
            if($tipo){
                $formato->tipoformato = $tipo;
                $formato->descripcion = $desc;
                $formato->save();
            }
            $response = new Response();
            $response->redirect('/formato'); //Retornar al index formato
            return $response;          
        }
    }

    public function eliminarAction()
    {
        $this->view->pick('formato/eliminar');
        $id = $this->dispatcher->getParams(); //Obtener el parametros de la Url
        $formato = Formatos::findFirst($id);
        $this->view->formato = $formato;
        if ($this->request->isPost()) {
            $formato->delete();
            $response = new Response();
            $response->redirect('/formato'); //Retornar al index formato
            return $response;
        }     
    }
}

