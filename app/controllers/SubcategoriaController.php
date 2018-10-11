<?php
use App\Models\Subcategorias;
use App\Models\Categorias;
use Phalcon\Http\Response;

class SubcategoriaController extends \Phalcon\Mvc\Controller
{
	public function indexAction()
    {
    	$this->view->pick('subcategoria/consultar');
    	$subcategorias = Subcategorias::find();
        $this->view->setVar('subcategoria', $subcategorias);        
    } 

    public function crearAction()
    {
    	$this->view->pick('subcategoria/crear');
    	$categorias = Categorias::find();
        $this->view->setVar('categoria', $categorias);    	
    	$this->view->setVar('error', false);
        if ($this->request->isPost()) {
            $subcategoria = new Subcategorias;
            $nombre = $this->request->getPost('nombreSubCat');
            $desc = $this->request->getPost('descSubCat');
            $codigo = $this->request->getPost('codSubCat');
            if($nombre && $desc && $codigo){
                $subcategoria->nombre = $nombre;
                $subcategoria->descripcion = $desc;
                $subcategoria->codigo = $codigo;
                $cat = $this->request->getPost('categoria');
                $categoria = Categorias::findFirst("nombre='".$cat."'");
                $subcategoria->idcategoria = $categoria->id;
                $subcategoria->save();
                $response = new Response();
                $response->redirect('/subcategoria'); //Retornar al index formato
                return $response;
            }
            else{
                $this->view->setVar('error', true); 
            }
        }
    }

    public function editarAction()
    {
    	$this->view->pick('subcategoria/editar');
        $id = $this->dispatcher->getParams(); //Obtener el parametros de la Url
        $subcategoria = Subcategorias::findFirst($id);
        $this->view->subcategoria = $subcategoria;
        $this->view->categoria = Categorias::find();
        $this->view->setVar('error', false);
        if ($this->request->isPost()) {            
            $nombre = $this->request->getPost('nombreCat');
            $desc = $this->request->getPost('descCat');
            $codigo = $this->request->getPost('codCat');
            if($nombre && $desc && $codigo){
                $subcategoria->nombre = $nombre;
                $subcategoria->descripcion = $desc;
                $subcategoria->codigo = $codigo;
                $cat = $this->request->getPost('categoria');
                $categoria = Categorias::findFirst("nombre='".$cat."'");
                $subcategoria->idcategoria = $categoria->id;
                $subcategoria->save();
                $response = new Response();
                $response->redirect('/subcategoria'); //Retornar al index formato
                return $response;
            }
            else{
                $this->view->setVar('error', true); 
            }
        }
    }

    public function eliminarAction()
 	{
 		$this->view->pick('subcategoria/eliminar');
 		$id = $this->dispatcher->getParams(); //Obtener el parametros de la Url
 		$subcategoria = Subcategorias::findFirst($id);
 		$this->view->subcategoria = $subcategoria;
 		if ($this->request->isPost()) {
            $subcategoria->delete();
            $response = new Response();
            $response->redirect('/subcategoria'); //Retornar al index formato
            return $response;
        }
 	}
}

