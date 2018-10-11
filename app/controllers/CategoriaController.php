<?php
use App\Models\Categorias;
use Phalcon\Http\Response;
class CategoriaController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
    	$this->view->pick('categoria/consultar');
    	$categorias = Categorias::find();
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
        $id = $this->dispatcher->getParams(); //Obtener el parametros de la Url
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
 		$id = $this->dispatcher->getParams(); //Obtener el parametros de la Url
 		$categoria = Categorias::findFirst($id);
 		$this->view->categoria = $categoria;
 		if ($this->request->isPost()) {
            $categoria->delete();
            $response = new Response();
            $response->redirect('/categoria'); //Retornar al index formato
            return $response;
        }
 	}

}

