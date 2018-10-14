<?php
use App\Models\Formatos;
use Phalcon\Http\Response;
use App\Models\Users;
use App\Validations\ValidacionFormato;
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
        $this->view->pick('formato/formato');
        $formatos = Formatos::find('idbiblioteca ='.$this->biblioteca->id);
        $this->view->setVar('formato', $formatos); 
        $this->view->setVar('error', false);
        if ($this->request->isPost()) {
            
            $validacion= new ValidacionFormato;
            $mensajes=[];
    
            $messages = $validacion->validate($_POST); //recoge las variables globales post
            
            //captura mensajes que son al respecto de los campos encontrados
            foreach ($messages as  $m) 
            {
                $mensajes[$m->getField()]=$m->getMessage();
            }
            
            if(!empty($mensajes))
            {   
                $this->flashSession->error('No se ha guardado el formato, algunos errores en los campos mencionados');
                
                //hace el bucle media vez halla capturado validaciones
                foreach ($mensajes as $mensaje ) {
                    $this->flashSession->warning($mensaje);                
                    
                }
    
               //redirige al mismo formulario
                $this->response->redirect('/formato');
                
            }
            else
            {//VALIDACION CON EXITO
                $formato = new Formatos;
                
                $tipo = $this->request->getPost('tipoFormato');
                $desc = $this->request->getPost('descFormato');

                $formato->idbiblioteca=$this->biblioteca->id;
                $formato->tipoformato = $tipo;
                $formato->descripcion = $desc;
                $formato->save();
                $response = new Response();
                $this->flashSession->success('El formato ha sido almacenado con exito');
                $response->redirect('/formato'); //Retornar al index formato
                return $response;

            }
    }
}

    public function editarAction()
    {
       $this->view->pick('formato/editar');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $formato = Formatos::findFirst($id);
        $this->view->formato = $formato;
        if ($this->request->isPost()) {
            // Accedemos a los datos POST            
            $validacion= new ValidacionFormato;
            $mensajes=[];
    
            $messages = $validacion->validate($_POST); //recoge las variables globales post
            
            //captura mensajes que son al respecto de los campos encontrados
            foreach ($messages as  $m) 
            {
                $mensajes[$m->getField()]=$m->getMessage();
            }
            
            if(!empty($mensajes))
            {   
                $this->flashSession->error('No se ha actualizado el formato, algunos errores en los campos mencionados');
                
                //hace el bucle media vez halla capturado validaciones
                foreach ($mensajes as $mensaje ) {
                    $this->flashSession->warning($mensaje);                
                    
                }
    
               //redirige al mismo formulario
                $this->response->redirect('/formato/editar/'.$id);
                
            }
            else
            {//VALIDACION CON EXITO
            $tipo = $this->request->getPost('tipoFormato');
            $desc = $this->request->getPost('descFormato');
  
                $formato->idbiblioteca=$this->biblioteca->id;
                $formato->tipoformato = $tipo;
                $formato->descripcion = $desc;
                $formato->save();
            $response = new Response();
            $this->flashSession->success('Formato actualizado con exito');
            $response->redirect('/formato'); //Retornar al index formato
            return $response;          
        }
    }
}
    public function eliminarAction()
    {
        $this->view->pick('formato/eliminar');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $formato = Formatos::findFirst($id);
        $this->view->formato = $formato;

             if ($this->request->isPost()) {
            if(isset($formato->recursos[0]))
            {
                $this->flashSession->error('El formato no puede ser borrado, debido a que hay recursos/libros que hacen uso de este!');
                $this->response->redirect('/formato');
            }
            else{

            $formato->delete();
            $response = new Response();
            $this->flashSession->success('El formato ha sido borrado con exito');
            $this->response->redirect('/formato'); //Retornar al index formato
               }
        }     
    }
}

