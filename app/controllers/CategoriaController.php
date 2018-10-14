<?php
use App\Models\Categorias;
use Phalcon\Http\Response;
use App\Models\Users;
class CategoriaController extends \Phalcon\Mvc\Controller
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
    	$this->view->pick('categoria/consultar');
    	$categorias = Categorias::find('idbiblioteca ='.$this->biblioteca->id);
        $this->view->setVar('categoria', $categorias);        
    }

    public function crearAction()
    {
    	$this->view->pick('categoria/crear');
    	$this->view->setVar('error', false);
        if ($this->request->isPost()) {
            $categoria = new Categorias;
            $nombre = $this->request->getPost('nombreCat');
            $desc = $this->request->getPost('descCat');
            $codigo = $this->request->getPost('codCat');
            if($nombre && $desc && $codigo){
                $categoria->nombre = $nombre;
                $categoria->descripcion = $desc;
                $categoria->codigo = $codigo;
                $categoria->idbiblioteca=$this->biblioteca->id;
                $categoria->save();
                $response = new Response();
                $response->redirect('/categoria'); //Retornar al index formato
                return $response;
            }
            else{
                $this->view->setVar('error', true); 
            }
        }
    }

    public function editarAction()
    {
    	$this->view->pick('categoria/editar');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $categoria = Categorias::findFirst($id);
        $this->view->categoria = $categoria;
        $this->view->setVar('error', false);
        if ($this->request->isPost()) {            
            $nombre = $this->request->getPost('nombreCat');
            $desc = $this->request->getPost('descCat');
            $codigo = $this->request->getPost('codCat');
            if($nombre && $desc && $codigo){
                $categoria->nombre = $nombre;
                $categoria->descripcion = $desc;
                $categoria->codigo = $codigo;
                $categoria->save();
                $response = new Response();
                $response->redirect('/categoria'); //Retornar al index formato
                return $response;
            }
            else{
                $this->view->setVar('error', true); 
            }
        }
    }
  
 	public function eliminarAction()
 	{
 		$this->view->pick('categoria/eliminar');
 		$id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
 		$categoria = Categorias::findFirst($id);
 		$this->view->categoria = $categoria;
 		if ($this->request->isPost()) {
            if(isset($categoria->subcategorias[0]))
            {   
                $this->flashSession->error('La categoria no se ha podido eliminar debido a que posee subcategorias');
                $this->response->redirect('/categoria');
            }
            else
            {
                $categoria->delete();
                $response = new Response();
                $this->flashSession->success('La categoria se ha borrado exitosamente');
                $response->redirect('/categoria'); //Retornar al index formato
                return $response;
            }

        }
 	}

}

