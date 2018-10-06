<?php
use App\Models\Formatos;
class FormatoController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
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
}

