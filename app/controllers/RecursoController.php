<?php
use App\Models\Recursos;
use App\Models\Formatos;
use App\Models\Materialesbibliograficos;
use App\Models\Subcategorias;
use App\Models\Unidades;
use App\Models\Bibliotecarios;
use Phalcon\Http\Response;
class RecursoController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
    	$this->view->pick('recurso/recurso');
    	$recursos = Recursos::find();
    	$formatos = Formatos::find();
    	$materiales = Materialesbibliograficos::find();
    	$subcategorias = Subcategorias::find();
        $this->view->setVar('recursos', $recursos);
        $this->view->setVar('formatos', $formatos);
        $this->view->setVar('materiales', $materiales); 
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
        $this->view->setVar('formatoActual', $formatoActual);
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

}

