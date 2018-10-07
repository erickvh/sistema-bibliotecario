<?php

use App\Models\Bibliotecas;
use Phalcon\Http\Response;

class BibliotecaController extends \Phalcon\Mvc\Controller
{
    public function consultarAction()
    {
        $bibliotecas=Bibliotecas::find();
        $this->view->pick('biblioteca/consultar');
        $this->view->bibliotecas= $bibliotecas;

    }

    public function editarAction()
    {
        $this->view->pick('biblioteca/editar');
        $id = $this->dispatcher->getParams(); //Obtener el parametros de la Url
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

}