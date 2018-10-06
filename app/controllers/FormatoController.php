<?php
use App\Models\Formatos;
use Phalcon\Http\Response;
class FormatoController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $formatos = Formatos::find();
        $this->view->setVar('formato', $formatos); 
        $this->view->pick('formato/formato');
        $this->view->setVar('error', false);
        if ($this->request->isPost()) {
            $formato = new Formatos;
            $tipo = $this->request->getPost('tipoFormato');
            $desc = $this->request->getPost('descFormato');
            if($tipo){
                $formato->tipoformato = $tipo;
                $formato->descripcion = $desc;
                $formato->save();
            }
            else{
                $this->view->setVar('error', true); 
            }
        }
    }

    public function crearAction()
    {
        $this->view->pick('formato/crear');
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

    public function editarAction()
    {
        $this->view->pick('formato/editar');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $formato = Formatos::findFirst($id);
        $this->view->formato = $formato;
        if ($this->request->isPost()) {
            // Accedemos a los datos POST            
            $tipo = $this->request->getPost('tipoFormato');
            $desc = $this->request->getPost('descFormato');
            if($tipo){
                $formato->tipoformato = $tipo;
                $formato->descripcion = $desc;
                $formato->save();
            }
            $response = new Response();
            $response->redirect('/formato'); //Retornar al index formato
            return $response;          
        }
    }

    public function eliminarAction()
    {
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $formato = Formatos::findFirst($id);
        $formato->delete();
        $response = new Response();
        $response->redirect('/formato'); //Retornar al index formato
        return $response;     
    }
}

