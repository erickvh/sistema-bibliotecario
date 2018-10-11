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
class RecursoController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
    	$this->view->pick('recurso/consultar');
        $materiales = Materialesbibliograficos::find();
        $this->view->setVar('materiales', $materiales);
    }

    public function crearAction()
    {
        $recursos = Recursos::find();
        $formatos = Formatos::find();        
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
            $material = new Materialesbibliograficos;
            $recurso = new Recursos;
            $unidad = new Unidades;
            $nomMaterial = $this->request->getPost('nombreMaterial');
            $formato = $this->request->getPost('tipoFormato');
            if($nomMaterial && $formato){
                $material->nombre = $nomMaterial;
                $material->descripcion = $this->request->getPost('descMaterial');
                $material->imagenurl = $this->request->getPost('imagenMaterial');
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
                $response->redirect('/recurso'); //Retornar al index recurso
                return $response;
            }
            else{
                $this->view->setVar('error', true); 
            }
        }
    }

    public function editarAction()
    {
        $this->view->pick('recurso/editar');
        $id = $this->dispatcher->getParams(); //Obtener parametros de la url
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
            $nomMaterial = $this->request->getPost('nombreMaterial');
            $formato = $this->request->getPost('tipoFormato');
            if($nomMaterial && $formato){
                $material->nombre = $nomMaterial;
                $material->descripcion = $this->request->getPost('descMaterial');
                $material->imagenurl = $this->request->getPost('imagenMaterial');
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
                $response->redirect('/recurso'); //Retornar al index recurso
                return $response;
            }
            else{
                $this->view->setVar('error', true); 
            }
        }
    }

    public function eliminarAction()
    {
        $this->view->pick('recurso/eliminar');
        $id = $this->dispatcher->getParams();
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
            $response = new Response();
            $response->redirect('/recurso'); //Retornar al index formato
            return $response;
        }     
    }   

}

