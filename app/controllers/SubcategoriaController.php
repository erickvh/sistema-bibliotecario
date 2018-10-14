<?php
use App\Models\Subcategorias;
use App\Models\Categorias;
use Phalcon\Http\Response;
use App\Models\Users;
use App\Validations\ValidacionSubcategoria;

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
            $this->view->disable();
            $validacion= new ValidacionSubcategoria;
            $mensajes=[];
    
            $messages = $validacion->validate($_POST); //recoge las variables globales post
            
            //captura mensajes que son al respecto de los campos encontrados
            foreach ($messages as  $m) 
            {
                $mensajes[$m->getField()]=$m->getMessage();
            }
            
            if(!empty($mensajes))
            {   
                $this->flashSession->error('No se ha guardado subcategoria, algunos errores en los campos mencionados');
                
                //hace el bucle media vez halla capturado validaciones
                foreach ($mensajes as $mensaje ) {
                    $this->flashSession->warning($mensaje);                
                    
                }
    
               //redirige al mismo formulario
                $this->response->redirect('/subcategoria/crear');
                
            }
            else
            {//VALIDACION CON EXITO

            $subcategoria = new Subcategorias;
            $nombre = $this->request->getPost('nombreCat');
            $desc = $this->request->getPost('descCat');
            $codigo = $this->request->getPost('codCat');
            
                $subcategoria->nombre = $nombre;
                $subcategoria->descripcion = $desc;
                $subcategoria->codigo = $codigo;
                $cat = $this->request->getPost('categoria');
                $categoria = Categorias::findFirst("nombre='".$cat."'");
                $subcategoria->idcategoria = $categoria->id;
                var_dump($subcategoria->save());
                $response = new Response();
                $this->flashSession->success('Subcategoria almacenada con exito');
                $response->redirect('/subcategoria'); //Retornar al index formato
                return $response;
            
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

            $validacion= new ValidacionSubcategoria;
            $mensajes=[];
    
            $messages = $validacion->validate($_POST); //recoge las variables globales post
            
            //captura mensajes que son al respecto de los campos encontrados
            foreach ($messages as  $m) 
            {
                $mensajes[$m->getField()]=$m->getMessage();
            }
            
            if(!empty($mensajes))
            {   
                $this->flashSession->error('No se ha actualizado subcategoria, algunos errores en los campos mencionados');
                
                //hace el bucle media vez halla capturado validaciones
                foreach ($mensajes as $mensaje ) {
                    $this->flashSession->warning($mensaje);                
                    
                }
    
               //redirige al mismo formulario
                $this->response->redirect('/subcategoria/editar/'.$id);
                
            }
            else
            {//VALIDACION CON EXITO

            $nombre = $this->request->getPost('nombreCat');
            $desc = $this->request->getPost('descCat');
            $codigo = $this->request->getPost('codCat');

            $subcategoria->nombre = $nombre;
            $subcategoria->descripcion = $desc;
            $subcategoria->codigo = $codigo;
            $cat = $this->request->getPost('categoria');
            $categoria = Categorias::findFirst("nombre='".$cat."'");
            $subcategoria->idcategoria = $categoria->id;
            $subcategoria->save();
            $response = new Response();
            $this->flashSession->success('Subcategoria actualizada con exito');
            $response->redirect('/subcategoria'); //Retornar al index formato
            return $response;
    
        }
    }
    }
    public function eliminarAction()
 	{
 		$this->view->pick('subcategoria/eliminar');
 		$id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
 		$subcategoria = Subcategorias::findFirst($id);
        $this->view->subcategoria = $subcategoria;
         
         if ($this->request->isPost()) 
         {
             if(isset($subcategoria->materialesbibliograficos[0]))
             {
                $this->flashSession->error('La subcategoria no se ha eliminado, debido a que existen recursos/libros asociados a ella');
                $this->response->redirect('/subcategoria');
             }
             else
             {
                $this->flashSession->success('La subcategoria se ha borrado exitosamente');
                $subcategoria->delete();
                $response = new Response();
                $response->redirect('/subcategoria'); //Retornar al index formato
                return $response;
            }
        }
 	}
}

