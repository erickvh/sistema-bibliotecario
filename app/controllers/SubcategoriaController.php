<?php
use App\Models\Subcategorias;
use App\Models\Categorias;
use Phalcon\Http\Response;
use App\Models\Users;

class SubcategoriaController extends \Phalcon\Mvc\Controller
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

    	$this->view->pick('subcategoria/consultar');
/**
 * Obtiene todos las subcategorias
 * crea un arreglo vacio
 * un indice que inicia desde cero
 */
        $subcategoriasGeneral = Subcategorias::find();    
        $subcategorias=[];
        $i=0;
    /**
     * recorre todas las subcategorias
     * las filtra si equivale con su padre categoria con id de la biblioteca
     */
            foreach ($subcategoriasGeneral as $sub) {
                if($sub->categorias->bibliotecas->id==$this->biblioteca->id)
                {  
                    $subcategorias[$i]= $sub;
                    ++$i;
                }
            }
 
        $this->view->setVar('subcategoria', $subcategorias);        
    } 

    public function crearAction()
    {
    	$this->view->pick('subcategoria/crear');
    	$categorias = Categorias::find('idbiblioteca ='.$this->biblioteca->id);
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
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $subcategoria = Subcategorias::findFirst($id);
        $this->view->subcategoria = $subcategoria;
        $this->view->categoria = Categorias::find('idbiblioteca ='.$this->biblioteca->id);
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
 		$id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
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

