<?php
use App\Models\Categorias;
use Phalcon\Http\Response;
use App\Models\Users;
use App\Validations\ValidacionCategoria;
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
    	$this->view->pick('Categoria/consultar');
    	$categorias = Categorias::find('idbiblioteca ='.$this->biblioteca->id);
        $this->view->setVar('categoria', $categorias);        
    }

    public function crearAction()
    {
       // $this->view->disable();
    	$this->view->pick('Categoria/crear');
    	$this->view->setVar('error', false);
        if ($this->request->isPost()) {

            $validacion= new ValidacionCategoria;
            $mensajes = $validacion->obtenerMensajes($_POST); 
  
            if(!empty($mensajes))
            {   
                $this->flashSession->error('No se ha guardado categoria, algunos errores en los campos mencionados');
                $validacion->gettingFlashMessages($mensajes);
                return $this->response->redirect('/categoria/crear');        
            }



            $categoria = new Categorias;
            $nombre = $this->request->getPost('nombreCat');
            $desc = $this->request->getPost('descCat');
            $codigo = $this->request->getPost('codCat');

                $categoria->nombre = $nombre;
                $categoria->descripcion = $desc;
                $categoria->codigo = $codigo;
                $categoria->idbiblioteca=$this->biblioteca->id;
                $categoria->save();
                $response = new Response();
                $this->flashSession->success('Categoria almacenada con exito');
                $response->redirect('/categoria'); //Retornar al index formato
                return $response;
        }
    }

    public function editarAction()
    {
    	$this->view->pick('Categoria/editar');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $categoria = Categorias::findFirst($id);
        $this->view->categoria = $categoria;
        $this->view->setVar('error', false);
        if ($this->request->isPost()) {            


            $validacion= new ValidacionCategoria;
            $validacion->setUpdate($id);
            
            $mensajes = $validacion->obtenerMensajes($_POST); 
  
            if(!empty($mensajes))
            {   
                $this->flashSession->error('No se ha actualizado categoria, algunos errores en los campos mencionados');
                
                $validacion->gettingFlashMessages($mensajes);
               //redirige al mismo formulario
                return $this->response->redirect('/categoria/editar/'.$id);                
            }

            $nombre = $this->request->getPost('nombreCat');
            $desc = $this->request->getPost('descCat');
            $codigo = $this->request->getPost('codCat');

            $categoria->nombre = $nombre;
            $categoria->descripcion = $desc;
            $categoria->codigo = $codigo;
            $categoria->save();
            $response = new Response();
            $this->flashSession->success('Categoria ha sido actualizada correctamente');
            $response->redirect('/categoria'); //Retornar al index formato
            return $response;
        }
    }

 	public function eliminarAction()
 	{
 		$this->view->pick('Categoria/eliminar');
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

