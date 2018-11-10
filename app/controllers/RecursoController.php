<?php
use App\Models\Recursos;
use App\Models\Formatos;
use App\Models\Materialesbibliograficos;
use App\Models\MaterialesAutores;
use App\Models\Subcategorias;
use App\Models\Unidades;
use App\Models\Bibliotecarios;
use App\Models\Autores;
use Phalcon\Http\Response;
use App\Models\Users;
use App\Validations\ValidacionRecurso;

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../../');
$dotenv->load();

class jsonDataO {
    public $file = "";
    public $api_key = "";
    public $timestamp = "";
    public $signature = "";
}

class RecursoController extends \Phalcon\Mvc\Controller
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
        $bibliotecario = Bibliotecarios::findFirst([
            'columns'    => 'idbiblioteca',
            'conditions' => 'iduser = ?1',
            'bind'       => [
                    1 => $idusuario,
                ]
        ]);
    	$this->view->pick('recurso/consultar');
        $recursos = Recursos::find();
        $this->view->setVar('recursos', $recursos);
        $this->view->idbiblioteca = $bibliotecario->idbiblioteca;
    }

    public function crearAction()
    {
        $recursos = Recursos::find();
        $formatos = Formatos::find('idbiblioteca ='.$this->biblioteca->id);        
        $subcategorias = Subcategorias::find();
        $this->view->setVar('recursos', $recursos);
        $this->view->setVar('formatos', $formatos);         
        $this->view->setVar('sub', $subcategorias); 
        $this->view->setVar('error', false);
        $idusuario = $this->session->get('id');
        $bibliotecario = Bibliotecarios::findFirst([
            'columns'    => 'idbiblioteca',
            'conditions' => 'iduser = ?1',
            'bind'       => [
                    1 => $idusuario,
                ]
        ]);
        $autores = Autores::find("idbiblioteca='".$bibliotecario->idbiblioteca."'");
        $this->view->autores = $autores;        
        if ($this->request->isPost()) {

            $validacion= new ValidacionRecurso;
            $mensajes=[];
    
            $messages = $validacion->validate($_POST); //recoge las variables globales post
            
            //captura mensajes que son al respecto de los campos encontrados
            foreach ($messages as  $m) 
            {
                $mensajes[$m->getField()]=$m->getMessage();
            }
            
            if(!empty($mensajes))
            {   
                $this->flashSession->error('No se ha guardado recurso, algunos errores en los campos mencionados');
                
                //hace el bucle media vez halla capturado validaciones
                foreach ($mensajes as $mensaje ) {
                    $this->flashSession->warning($mensaje);                
                    
                }
    
               //redirige al mismo formulario
                $this->response->redirect('/recurso/crear');
                
            }
            else
            {//VALIDACION CON EXITO

            $material = new Materialesbibliograficos;
            $recurso = new Recursos;
            $unidad = new Unidades;
            $nomMaterial = $this->request->getPost('nombreMaterial');
            $formato = $this->request->getPost('tipoFormato');
           
            $material->nombre = $nomMaterial;
            $material->descripcion = $this->request->getPost('descMaterial');
            $material->nombreimagen = $this->request->getPost('nomImgMaterial');
            
            $logourl=$this->request->getUploadedFiles('imagenMaterial'); //esto debe ser traido por cloud dinary

            $material->imagenurl = $this->guardarCloudinary($logourl);


            if($this->request->getPost('fechaMaterial'))
            {
                $material->fechapublicacion = $this->request->getPost('fechaMaterial');
            }
            
            if($this->request->getPost('externoMaterial'))
            {
                $material->esexterno = true;
            }
            else
            {
                $material->esexterno = false;
            }                
            $material->idbiblioteca = $bibliotecario->idbiblioteca;
            $sub = $this->request->getPost('subMaterial');
            $subcategoria = Subcategorias::findFirst("nombre='".$sub."'");
            $material->idsubcategoria = $subcategoria->id;
            $material->save();
            foreach ($this->request->getPost('autoresRecurso') as $aut){
                    $MaterialAutor = new MaterialesAutores;
                    $MaterialAutor->idautor=$aut;
                    $MaterialAutor->idmaterial=$material->id;
                    $MaterialAutor->save();
            }
            $formId = Formatos::findFirst("tipoformato='".$formato."'");
            $recurso->idformato = $formId->id;
            $recurso->idmaterial = $material->id;
            $unidad->unidadesexistentes = $this->request->getPost('cantidadMaterial');
            $unidad->idmaterial = $material->id;
            $unidad->save();
            $recurso->save();
            $response = new Response();
            $this->flashSession->success('Recurso fue guardado correctamente');
            $response->redirect('/recurso'); //Retornar al index recurso
            return $response;
           
        }
    }
}
    public function editarAction()
    {
        $this->view->pick('recurso/editar');
        $id = $this->dispatcher->getParam('id'); //Obtener parametros de la url
        /* Para llenar el formulario
        con sus datos Actuales */
        $material = Materialesbibliograficos::findFirst($id);
        $formatos = Formatos::find();
        $recursoActual = Recursos::findFirst("idmaterial='".$material->id."'");
        $formatoActual = Formatos::findFirst("id='".$recursoActual->idformato."'");
        $subcategorias = Subcategorias::find();
        $subCatActual = Subcategorias::findFirst($material->idsubcategoria);
        $unidadesExis = Unidades::findFirst("idmaterial='".$material->id."'");        
        $this->view->material = $material;
        $this->view->setVar('formatos', $formatos);
        $this->view->setVar('sub', $subcategorias);
        $this->view->setVar('recursoActual', $recursoActual);
        $this->view->setVar('subActual', $subCatActual);
        $this->view->setVar('unidades', $unidadesExis);

        /* Actualizar el formulario Recurso */
        $idusuario = $this->session->get('id');
        $bibliotecario = Bibliotecarios::findFirst([
            'columns'    => 'idbiblioteca',
            'conditions' => 'iduser = ?1',
            'bind'       => [
                    1 => $idusuario,
                ]
        ]);
        $autores = Autores::find("idbiblioteca='".$bibliotecario->idbiblioteca."'");
        $MatAut = MaterialesAutores::find("idmaterial='".$material->id."'");
        $this->view->autores = $autores;
        $this->view->mataut = $MatAut;
        if ($this->request->isPost()) {
            $validacion= new ValidacionRecurso;
            $mensajes=[];
    
            $messages = $validacion->validate($_POST); //recoge las variables globales post
            
            //captura mensajes que son al respecto de los campos encontrados
            foreach ($messages as  $m) 
            {
                $mensajes[$m->getField()]=$m->getMessage();
            }
            
            if(!empty($mensajes))
            {   
                $this->flashSession->error('No se ha guardado recurso, algunos errores en los campos mencionados');
                
                //hace el bucle media vez halla capturado validaciones
                foreach ($mensajes as $mensaje ) {
                    $this->flashSession->warning($mensaje);                
                    
                }
    
               //redirige al mismo formulario
                $this->response->redirect('/recurso/editar/'.$id);
                
            }
            else
            {//VALIDACION CON EXITO            
            $nomMaterial = $this->request->getPost('nombreMaterial');
            $formato = $this->request->getPost('tipoFormato');
          
                $material->nombre = $nomMaterial;
                $material->descripcion = $this->request->getPost('descMaterial');
                $logourl=$this->request->getUploadedFiles('imagenMaterial'); //esto debe ser traido por cloud dinary
                $material->imagenurl = $this->guardarCloudinary($logourl);
                $material->nombreimagen = $this->request->getPost('nomImgMaterial');
                if($this->request->getPost('fechaMaterial'))
                {
                    $material->fechapublicacion = $this->request->getPost('fechaMaterial');
                }
                
                if($this->request->getPost('externoMaterial'))
                {
                    $material->esexterno = true;
                }
                else
                {
                    $material->esexterno = false;
                }
                foreach ($MatAut as $autmat){
                    $i=0;
                    foreach ($this->request->getPost('autoresRecurso') as $aut){
                        if($aut==$autmat->idautor){
                            $i++;
                        }
                    }
                    if($i==0){
                        $autmat->delete();
                    }
                }
                
                foreach ($this->request->getPost('autoresRecurso') as $aut){
                    
                    if (count(MaterialesAutores::find("idmaterial = '".$material->id."' and idautor = '".$aut."'"))==0){
                        $MaterialAutor = new MaterialesAutores;
                        $MaterialAutor->idautor=$aut;
                        $MaterialAutor->idmaterial=$material->id;
                        $MaterialAutor->save();
                    }
                }
                $sub = $this->request->getPost('subMaterial');
                $subcategoria = Subcategorias::findFirst("nombre='".$sub."'");
                $material->idsubcategoria = $subcategoria->id;
                $material->save();
                $unidadesExis->unidadesexistentes = $this->request->getPost('cantidadMaterial');              
                $unidadesExis->save();
                $formId = Formatos::findFirst("tipoformato='".$formato."'");
                $recursoActual->idformato = $formId->id;
                $recursoActual->save();
                $response = new Response();
                $this->flashSession->success('Recurso ha sido actualizado correctamente');
                $response->redirect('/recurso'); //Retornar al index recurso
                return $response;
                  }
    }
    }
    public function eliminarAction()
    {
        $this->view->pick('recurso/eliminar');
        $id = $this->dispatcher->getParam('id');
        $material = Materialesbibliograficos::findFirst($id);
        $unidades = Unidades::findFirst("idmaterial='".$material->id."'");
        $recurso = Recursos::findFirst("idmaterial='".$material->id."'");
        $MatAut = MaterialesAutores::find("idmaterial='".$material->id."'");
        $this->view->material = $material;        
        if ($this->request->isPost()) 
        { 
            $unidades->delete();            
            $recurso->delete();            
            foreach ($MatAut as $autmat){
                $autmat->delete();
            }
            $material->delete();
            $this->flashSession->success('Recurso eliminado con exito');
            $response = new Response();
            $response->redirect('/recurso'); //Retornar al index formato
            return $response;
        }     
    }
    
    public function verAction()
    {
        $this->view->pick('recurso/ver');
        $id = $this->dispatcher->getParam('id'); //Obtener parametros de la url
        /* Para llenar el formulario
        con sus datos Actuales */
        /* Actualizar el formulario Recurso */
        $idusuario = $this->session->get('id');
        $bibliotecario = Bibliotecarios::findFirst([
            'columns'    => 'idbiblioteca',
            'conditions' => 'iduser = ?1',
            'bind'       => [
                    1 => $idusuario,
                ]
        ]);
        $material = Materialesbibliograficos::findFirst($id);
        $formatos = Formatos::find();
        $recursoActual = Recursos::findFirst("idmaterial='".$material->id."'");        
        $subcategorias = Subcategorias::find();       
        $unidadesExis = Unidades::findFirst("idmaterial='".$material->id."'");      
        $autores = Autores::find("idbiblioteca='".$bibliotecario->idbiblioteca."'");
        $MatAut = MaterialesAutores::find("idmaterial='".$material->id."'");
        $this->view->autores = $autores;
        $this->view->mataut = $MatAut;
        $this->view->material = $material;
        $this->view->setVar('formatos', $formatos);
        $this->view->setVar('sub', $subcategorias);
        $this->view->setVar('recursoActual', $recursoActual);        
        $this->view->setVar('unidades', $unidadesExis);       
    }

    // Funcion usada en crear y editar para guardar la imagen en cloudinary
    public function guardarCloudinary($logourl){
        
        //preparando parametros para cloudinary
        $cloud_name = getenv("CLOUDINARY_cloudName");
        $api_key = getenv("CLOUDINARY_apiKey");
        $api_secret = getenv("CLOUDINARY_apiSecret");
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

