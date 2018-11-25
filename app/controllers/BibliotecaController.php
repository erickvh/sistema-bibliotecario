<?php

use App\Models\Bibliotecas;
use App\Models\Users;
use App\Validations\ValidacionBiblioteca;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RolMiddleware;
use App\Middlewares\NoResulSetMiddleware;
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../../');
$dotenv->load();

class jsonDataO {
    public $file = "";
    public $api_key = "";
    public $timestamp = "";
    public $signature = "";
}

class BibliotecaController extends \Phalcon\Mvc\Controller
{
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
                    case 'Bibliotecario': 
                    case 'Prestamista':
                    $this->response->redirect('/401');
                    break;
                    case 'Administrador':
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
        $bibliotecas=Bibliotecas::find();
        $this->view->pick('biblioteca/consultar');
        $this->view->bibliotecas= $bibliotecas;

    }

    public function deshabilitarAction(){


        $id=$this->dispatcher->getParam('id');
        $biblioteca=Bibliotecas::findFirst($id);
        $this->view->pick('biblioteca/deshabilitar');
        $this->view->biblioteca=$biblioteca;
        if($this->request->isPost()){

            $biblioteca->habilitado=$biblioteca->habilitado? false:true;
            $biblioteca->save();
            $this->response->redirect('biblioteca');

        }
    }

    public function editarAction()
    {
        $this->view->pick('biblioteca/editar');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $biblioteca = Bibliotecas::findFirst($id);
        $notFoundMiddleware=new NoResulSetMiddleware;
        $notFoundMiddleware->middleware($biblioteca,$this->dispatcher);

        $this->view->biblioteca = $biblioteca;
        if ($this->request->isPost()) {
            $validacion= new ValidacionBiblioteca;
            $validacion->setUpdate($id);
            $mensajes=$validacion->obtenerMensajes($_POST);
            
            if(!empty($mensajes))
            {   
                $this->flashSession->error('No se ha guardado biblioteca, algunos errores en los campos mencionados');
                $validacion->gettingFlashMessages($mensajes);
                //redirige al mismo formulario
                return $this->response->redirect('/biblioteca/editar/'.$id);   
            }

            $nombre = $this->request->getPost('nombreBiblioteca');
            $ubicacion = $this->request->getPost('ubicacionBiblioteca');
            $telefono = $this->request->getPost('telefonoBiblioteca');
            $clasificacion = $this->request->getPost('clasBiblioteca');
            $logourl = $this->request->getUploadedFiles('imagenbiblioteca'); //esto debe ser traido por cloud dinary
            $nombrelogo = $this->request->getPost('nomlogoBiblioteca');
            $email = $this->request->getPost('emailBiblioteca');
                
            $biblioteca->nombre = $nombre;
            $biblioteca->ubicacion = $ubicacion;
            $biblioteca->telefono = $telefono;
            $biblioteca->clasificaion = $clasificacion;
            if($logourl){
            $biblioteca->logourl = $this->guardarCloudinary($logourl);
                        }
            $biblioteca->nombrelogo = $nombrelogo;
            $biblioteca->email = $email;
            $biblioteca->save();
            

            $this->flashSession->success('La biblioteca fue actualizada con exito');
            $this->response->redirect('/biblioteca'); //Retornar a biblioteca
            return $response;          
            }
        }
    

    
    public function crearAction(){
        $this->view->pick('biblioteca/crear');
        $biblioteca= new Bibliotecas;
        
        if ($this->request->isPost()) {

            $validacion= new ValidacionBiblioteca;
            $mensajes=$validacion->obtenerMensajes($_POST);

            
            if(!empty($mensajes))
            {   
                $this->flashSession->error('No se ha guardado bibliotecario, algunos errores en los campos mencionados');
                
                $validacion->gettingFlashMessages($mensajes);
               //redirige al mismo formulario
                return $this->response->redirect('/biblioteca/crear');                
            }

            $nombre = $this->request->getPost('nombreBiblioteca');
            $ubicacion = $this->request->getPost('ubicacionBiblioteca');
            $telefono = $this->request->getPost('telefonoBiblioteca');
            $clasificacion = $this->request->getPost('clasBiblioteca');
            $logourl = $this->request->getUploadedFiles('imagenbiblioteca'); //esto debe ser traido por cloud dinary
            $nombrelogo = $this->request->getPost('nomlogoBiblioteca');
            $email = $this->request->getPost('emailBiblioteca');

        //guardando los datos en el nuevo objeto de tipo bibliotec
        if($email)
        { 
        $biblioteca->email =  $email;  
        }
        
        //guardando los datos en el nuevo objeto de tipo biblioteca

        $biblioteca->nombre= $nombre;
        $biblioteca->ubicacion = $ubicacion ;   
        $biblioteca->telefono = $telefono ;   
        $biblioteca->clasificacion =$clasificacion;  

        $biblioteca->logourl =  $this->guardarCloudinary($logourl);   
        $biblioteca->nombrelogo =  $nombrelogo ;   
        $biblioteca->email =  $email;  
        $guardado = $biblioteca->save();
        $this->flashSession->success('La biblioteca fue guardada con exito');
        $this->response->redirect('/biblioteca');
    }
}

    public function verAction()
    {
        $this->view->pick('biblioteca/ver');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $biblioteca = Bibliotecas::findFirst($id);
        $notFoundMiddleware=new NoResulSetMiddleware;
        //$notFoundMiddleware->middleware($biblioteca,$this->dispatcher);

        $this->view->biblioteca = $biblioteca;
    }

    // Funcion usada en crear y editar para guardar la imagen en cloudinary
    public function guardarCloudinary($logourl){
        
        //preparando parametros para cloudinary
        $cloud_name = "sistemabibliotecario" ;
        $api_key ="475842337293294" ;
        $api_secret = "NtibDeOCVqupbINO_RHmhkWNicA";
        $timestamp = time();
        $signature = sha1("timestamp=".(string)$timestamp.$api_secret);
        foreach ($logourl as $url){
            $tmpDir=$url->getTempName();
        }
        //imagen a base64
        $data = file_get_contents($tmpDir);
        $base64 = 'data:image/jpeg;base64,' . base64_encode($data);
        //POST a cloudinary
        $url="https://api.cloudinary.com/v1_1/".$cloud_name."/image/upload";
        $ch = curl_init($url);

        $jsonData = new jsonDataO;
        $jsonData->file = $base64;
        $jsonData->api_key = $api_key;
        $jsonData->timestamp = $timestamp;
        $jsonData->signature = $signature;

        $payload = json_encode($jsonData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //$result = new jsonR;
        $result = curl_exec($ch);
        curl_close($ch);
        $url = json_decode($result);

        return $url->{'url'};              
    }

}