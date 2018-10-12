<?php

use App\Models\Bibliotecas;
use Phalcon\Http\Response;
use App\Models\Users;

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
        $this->view->biblioteca = $biblioteca;
        if ($this->request->isPost()) {
            // Accedemos a los datos POST            
            $nombre = $this->request->getPost('nombreBiblioteca');
            $ubicacion = $this->request->getPost('ubicacionBiblioteca');
            $telefono = $this->request->getPost('telefonoBiblioteca');
            $clasificacion = $this->request->getPost('clasBiblioteca');
            $logourl = $this->request->getPost('logourlBiblioteca');
            $nombrelogo = $this->request->getPost('nomlogoBiblioteca');
            $email = $this->request->getPost('emailBiblioteca');
            if($nombre and $ubicacion and $telefono){
                $biblioteca->nombre = $nombre;
                $biblioteca->ubicacion = $ubicacion;
                $biblioteca->telefono = $telefono;
                $biblioteca->clasificaion = $clasificacion;
                $biblioteca->logourl = $logourl;
                $biblioteca->nombrelogo = $nombrelogo;
                $biblioteca->email = $email;
                $biblioteca->save();
            }
            $response = new Response();
            $response->redirect('/biblioteca'); //Retornar a biblioteca
            return $response;          
        }
    }

    
    public function crearAction(){
        $this->view->pick('biblioteca/crear');
        $biblioteca= new Bibliotecas;

        $nombre = $this->request->getPost('nombreBiblioteca');
        $ubicacion = $this->request->getPost('ubicacionBiblioteca');
        $telefono = $this->request->getPost('telefonoBiblioteca');
        $clasificacion = $this->request->getPost('clasBiblioteca');
        $logourl = $this->request->getPost('logourlBiblioteca');
        $nombrelogo = $this->request->getPost('nomlogoBiblioteca');
        $email = $this->request->getPost('emailBiblioteca');

        //guardando los datos en el nuevo objeto de tipo biblioteca

        $biblioteca->nombre= $nombre;
        $biblioteca->ubicacion = $ubicacion ;   
        $biblioteca->telefono = $telefono ;   
        $biblioteca->clasificacion =$clasificacion;   
        $biblioteca->logourl =  $logourl ;   
        $biblioteca->nombrelogo =  $nombrelogo ;   
        $biblioteca->email =  $email;  
        $guardado = $biblioteca->save();
        
        if($guardado == true){
             $this->response->redirect('/biblioteca');
        }
     //   $response = new Response();
      //  $response->redirect('/biblioteca'); //Retornar a biblioteca
      //  return $response;       
    //   

         
    }

}