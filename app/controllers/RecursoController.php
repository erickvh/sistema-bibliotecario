<?php
use App\Models\Recursos;
use App\Models\Formatos;
use App\Models\Materialesbibliograficos;
class RecursoController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
    	$this->view->pick('recurso/recurso');
    	$recursos = Recursos::find();
    	$formatos = Formatos::find();
    	$materiales = Materialesbibliograficos::find();
        $this->view->setVar('recursos', $recursos);
        $this->view->setVar('formatos', $formatos);
        $this->view->setVar('materiales', $materiales); 
        $this->view->setVar('error', false);
        if ($this->request->isPost()) {
            $formato = new Formatos;
            $tipo = $this->request->getPost('tipoFormato');
            $desc = $this->request->getPost('descFormato');
            if($tipo){
                $formato->tipoformato = $tipo;
                $formato->descripcion = $desc;
                $formato->save();
                $response = new Response();
                $response->redirect('/formato'); //Retornar al index formato
                return $response;
            }
            else{
                $this->view->setVar('error', true); 
            }
        }
    }

}

