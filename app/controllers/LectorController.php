<?php
use App\Models\Bibliotecas;
use Phalcon\Http\Response;
use App\Models\Users;
use App\Validations\ValidacionLector;
use App\Models\Bibliotecarios;
use App\Models\Prestamistas;
use App\Models\Municipios;
use  Carbon\Carbon;


class LectorController extends \Phalcon\Mvc\Controller
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
   $idusuario = $this->session->get('id');
   $prestamistas= Prestamistas::find('idbibilioteca ='.$this->biblioteca->id);

   $this->view->pick('lector/consultar');
   $this->view->prestamistas= $prestamistas;
  
    }

    public function crearAction() {
       $this->view->pick('lector/crear');    
        
        //obteniendo los municipios para mostrarlos en el combox 
        $municipios= Municipios::find();          
        $this->view->municipios = $municipios;
         
        $user= new Users();
        $prestamista= new Prestamistas();
        if ($this->request->isPost()) {
        //validaciones correspondientes
        $validacion= new ValidacionLector;
        $mensajes=$validacion->obtenerMensajes($_POST);

        if(!empty($mensajes))
        {   
            $this->flashSession->error('No se ha guardado el lector, existen algunos errores en los campos mencionados');
            $validacion->gettingFlashMessages($mensajes);            
           //redirige al mismo formulario
            return $this->response->redirect('/lector/crear');
            
        }   
        
        $username=$this->request->getPost('usuario'); 
        $password=$this->generatePassword();
        $email=$this->request->getPost('email'); 
        $fechanacimiento=$this->request->getPost('fechanacimiento'); 
        $nombre=$this->request->getPost('nombre'); 
        $sexo=$this->request->getPost('sexo'); 
        $idrol=3;
        //datos del prestamista
        $lugardeestudio= $this->request->getPost('lugardeestudio');
        $ocupacion= $this->request->getPost('ocupacion');
        if($ocupacion == 'estudiante'){
            $prestamista->estudia= true;
            $prestamista->trabaja= false;
        } elseif($ocupacion == 'trabajador'){
            $prestamista->estudia= false;
            $prestamista->trabaja= true;
        } else {
            $prestamista->estudia= true;
            $prestamista->trabaja= true;
        }
        $direccion= $this->request->getPost('direccion');
        $nombrePadre= $this->request->getPost('nombrePadre');
        $nombreMadre= $this->request->getPost('nombreMadre');
        $telefono= $this->request->getPost('telefono'); //
        $activo= true;
        //inicializando los datos de idmunicipio y idbibilioteca en la entidad prestamista
        $prestamista->idmunicipio = $this->request->getPost('municipio');
        $prestamista->idbibilioteca = $this->biblioteca->id;
        //guardando los datos en las entidades correspondientes
        $user->username= $username;
        $user->password=$this->security->hash($password);
        if($email)
        {
            $user->email=$email;
        } 
        $user->fechanacimiento=$fechanacimiento;
        $user->nombre=$nombre;
        $user->sexo=$sexo;
        $user->idrol=$idrol;
        $user->save();
        
        $prestamista->lugardeestudio=$lugardeestudio;
        $prestamista->direccion= $direccion;
        $prestamista->nombredepadre= $nombrePadre;
        $prestamista->nombredemadre= $nombreMadre;
        $prestamista->telefono= $telefono;
        $prestamista->activo= $activo;
        $prestamista->iduser= $user->id;
        $prestamista->save();

        $response = new Response();
        $this->flashSession->success('Lector almacenado corectamente! Contraseña temporal: '.$password);
        $response->redirect('/lector'); //Retornar a lector
        return $response;   
        }
      

      }


    //generador de password
    private function generatePassword(){

        $cadena =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $cadena .= '0123456789' ;
        $password = '';
        $limite = strlen($cadena) - 1;
 
        for ($i=0; $i < 5; $i++)
        $password .= $cadena[rand(0, $limite)];
        return $password;
    }
    public function mostrarPasswordAction(){

    }
   
    public function verAction(){
        $id=$this->dispatcher->getParam('id');
        $prestamista=Prestamistas::findFirst($id);
        $trabaja=$prestamista->trabaja;
        $estudia=$prestamista->estudia;
        $municipio = Municipios::find("id='".$prestamista->idmunicipio."'");
        if($trabaja=='true' && $estudia=='true'){
            $ocupacion='Trabaja y estudia'; 
        }elseif($estudia=='true'){
            $ocupacion='estudiante';
        }else{
            $ocupacion='trabajador';
        }
        $this->view->pick("lector/ver");
        $this->view->prestamista=$prestamista;
        $this->view->municipio=$municipio;
        $this->view->ocupacion=$ocupacion;
    }

    public function deshabilitarAction(){


        $id=$this->dispatcher->getParam('id');
        $prestamista=Prestamistas::findFirst($id);
        $this->view->pick('lector/deshabilitar');
        $this->view->prestamista=$prestamista;
        if($this->request->isPost()){

            $prestamista->activo=$prestamista->activo? false:true;
            $prestamista->save();
            $this->response->redirect('lector');

        }
    }

    public function editarAction()
    {  
        $this->view->pick("lector/editar");
        $id=$this->dispatcher->getParam('id');
        $prestamista=Prestamistas::findFirst($id);

        $trabaja=$prestamista->trabaja;
        $estudia=$prestamista->estudia;
        $municipio = Municipios::find("id='".$prestamista->idmunicipio."'");
    
        if($trabaja=='true' && $estudia=='true'){
            $ocupacion='Trabaja y estudia'; 
        }elseif($estudia=='true'){
            $ocupacion='estudiante';
        }else{
            $ocupacion='trabajador';
        }
        //obteniendo los municipios para mostrarlos en el combox 
        $municipios= Municipios::find();          
        $this->view->municipios = $municipios;

        $this->view->prestamista=$prestamista;
        $this->view->municipio=$municipio;
        $this->view->ocupacion=$ocupacion;
        if ($this->request->isPost()) {
            $validacion= new ValidacionLector;
            $validacion->setUpdate($id);
            $mensajes=$validacion->obtenerMensajes($_POST);
    
            
                   if(!empty($mensajes))
                   {   
                       $this->flashSession->error('No se ha actualizado Lector, algunos errores en los campos mencionados');
                       
                        $validacion->gettingFlashMessages($mensajes);
                      //redirige al mismo formulario
                        return $this->response->redirect('/lector/editar/'.$id);
                       
                   }
        $username=$this->request->getPost('usuario');
        $email=$this->request->getPost('email');
        $prestamista->users->fechanacimiento=$this->request->getPost('fechanacimiento');
        $prestamista->users->nombre=$this->request->getPost('nombre');
        $prestamista->users->sexo=$this->request->getPost('sexo');
        //datos del prestamista
        $prestamista->lugardeestudio= $this->request->getPost('lugardeestudio');
        $ocupacion= $this->request->getPost('ocupacion');
        if($ocupacion == 'estudiante'){
            $prestamista->estudia= true;
            $prestamista->trabaja= false;
        } elseif($ocupacion == 'trabajador'){
            $prestamista->estudia= false;
            $prestamista->trabaja= true;
        } else {
            $prestamista->estudia= true;
            $prestamista->trabaja= true;
        }
        $prestamista->direccion= $this->request->getPost('direccion');
        $prestamista->nombrePadre= $this->request->getPost('nombrePadre');
        $prestamista->nombreMadre= $this->request->getPost('nombreMadre');
        $prestamista->telefono= $this->request->getPost('telefono');
        $prestamista->idmunicipio = $this->request->getPost('municipio');
         
        $prestamista->users->username= $username;
        $prestamista->save();
        $response = new Response();
        $this->flashSession->success('Lector actualizado con exito');
        $response->redirect('/lector'); //Retornar la vista del lector
        return $response;
        }

    }



}