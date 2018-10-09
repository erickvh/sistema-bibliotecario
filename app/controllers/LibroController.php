<?php

use App\Models\Libros;
use App\Models\Materialesbibliograficos;
use App\Models\Bibliotecarios;
use App\Models\Unidades;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Models\Autores;
use App\Models\MaterialesAutores;
use Phalcon\Http\Response;


class LibroController extends \Phalcon\Mvc\Controller
{
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

        $libros = Libros::find();

        /*$libros = $libros->filter(
            function ($libro) {
                if ($libro->Materialesbibliograficos->idbiblioteca == $bibliotecario->idbiblioteca) {
                    return $libro;
                }
            }
        );*/
        
        $this->view->pick('libro/consultar');
        $this->view->libros= $libros;
        $this->view->bib= $bibliotecario->idbiblioteca;

    }

    public function crearAction()
    {
        $subcategorias= Subcategorias::find();
        $autores = Autores::find();
        $this->view->pick('libro/crear');
        $this->view->subcategorias = $subcategorias;
        $this->view->autores = $autores;

        $idusuario = $this->session->get('id');
        $bibliotecario = Bibliotecarios::findFirst([
            'columns'    => 'idbiblioteca',
            'conditions' => 'iduser = ?1',
            'bind'       => [
                    1 => $idusuario,
                ]
        ]);

        $libro=new Libros;
        $material=new Materialesbibliograficos;
        $unidades= new Unidades;
        $material->idbiblioteca=$bibliotecario->idbiblioteca;

        if ($this->request->isPost()) {
            // Accedemos a los datos POST            
            $nombre = $this->request->getPost('nomLibro');
            $esexterno=$this->request->getPost('exLibro');
            $cantunidades=$this->request->getPost('cantidadLibro');
            if($nombre and $cantunidades){
                $material->nombre=$nombre;
                $material->descripcion=$this->request->getPost('descLibro');
                $libro->editorial=$this->request->getPost('editLibro');
                $libro->volumen=$this->request->getPost('volLibro');
                $libro->sinopsis=$this->request->getPost('sinLibro');
                if($this->request->getPost('fpub'))
                {
                    $material->fechapublicacion=$this->request->getPost('fpub');
                }
                
                if($esexterno)
                {
                    $material->esexterno = true;
                }
                else
                {
                    $material->esexterno = false;
                }

                $material->imagenurl=$this->request->getPost('imagenLibro');
                $material->nombreimagen=$this->request->getPost('nomImgLibro');
                $material->idsubcategoria = $this->request->getPost('subLibro');
                $material->save();
                $unidades->unidadesexistentes=$cantunidades;
                $unidades->idmaterial=$material->id;
                $unidades->save();
                
                $libro->idmaterial=$material->id;
                $libro->save();
                
                foreach ($this->request->getPost('autoresLibro') as $aut){
                        $MaterialAutor = new MaterialesAutores;
                        $MaterialAutor->idautor=$aut;
                        $MaterialAutor->idmaterial=$material->id;
                        $MaterialAutor->save();
                }
                
                
            }
            $response = new Response();
            $response->redirect('/libro'); //Retornar a libro
            return $response;          
        }
        
    }

    public function editarAction()
    {
        $this->view->pick('libro/editar');
        $id = $this->dispatcher->getParams(); //Obtener el parametros de la Url
        $libro = Libros::findFirst($id);
        $unidades = Unidades::findFirst("idmaterial='".$libro->idmaterial."'");
        $categorias= Categorias::find();
        $subcategorias= Subcategorias::find();
        $autores = Autores::find();
        $MatAut = MaterialesAutores::find("idmaterial='".$libro->idmaterial."'");
        $this->view->libro = $libro;
        $this->view->unidades = $unidades;
        $this->view->categorias = $categorias;
        $this->view->subcategorias = $subcategorias;
        $this->view->autores = $autores;
        $this->view->mataut = $MatAut;

        if ($this->request->isPost()) {
            // Accedemos a los datos POST            
            $nombre = $this->request->getPost('nomLibro');
            $esexterno=$this->request->getPost('exLibro');
            if($nombre){
                $libro->MaterialesBibliograficos->nombre=$nombre;
                $libro->MaterialesBibliograficos->descripcion=$this->request->getPost('descLibro');
                $libro->editorial=$this->request->getPost('editLibro');
                $libro->volumen=$this->request->getPost('volLibro');
                $libro->sinopsis=$this->request->getPost('sinLibro');
                if($this->request->getPost('fpub'))
                {
                    $libro->MaterialesBibliograficos->fechapublicacion=$this->request->getPost('fpub');
                }
                
                if($esexterno)
                {
                    $libro->MaterialesBibliograficos->esexterno = true;
                }
                else
                {
                    $libro->MaterialesBibliograficos->esexterno = false;
                }

                foreach ($MatAut as $autmat){
                    $i=0;
                    foreach ($this->request->getPost('autoresLibro') as $aut){
                        if($aut==$autmat->idautor){
                            $i++;
                        }
                    }
                    if($i==0){
                        $autmat->delete();
                    }
                }
                
                foreach ($this->request->getPost('autoresLibro') as $aut){
                    
                    if (count(MaterialesAutores::find("idmaterial = '".$libro->idmaterial."' and idautor = '".$aut."'"))==0){
                        $MaterialAutor = new MaterialesAutores;
                        $MaterialAutor->idautor=$aut;
                        $MaterialAutor->idmaterial=$libro->idmaterial;
                        $MaterialAutor->save();
                    }
                }
                
                $libro->MaterialesBibliograficos->imagenurl=$this->request->getPost('imagenLibro');
                $libro->MaterialesBibliograficos->nombreimagen=$this->request->getPost('nomImgLibro');
                $libro->Materialesbibliograficos->idsubcategoria = $this->request->getPost('subLibro');
                $unidades->unidadesexistentes=$this->request->getPost('cantidadLibro');
                $unidades->save();
                $libro->MaterialesBibliograficos->save();
                $libro->save();
            }
            $response = new Response();
            $response->redirect('/libro'); //Retornar a libro
            return $response;          
        }
    }

    public function eliminarAction()
    {
        $this->view->pick('libro/eliminar');
        $id = $this->dispatcher->getParams(); //Obtener el parametros de la Url
        $libro = Libros::findFirst($id);
        $this->view->libro = $libro;
        if ($this->request->isPost()) {
            $material=Materialesbibliograficos::findFirst($libro->idmaterial);
            $unidades=Unidades::findFirst("idmaterial='".$libro->idmaterial."'");
            $MatAut = MaterialesAutores::find("idmaterial='".$libro->idmaterial."'");
            $libro->delete();
            $unidades->delete();
            foreach ($MatAut as $autmat){
                $autmat->delete();
            }
            $material->delete();
            $response = new Response();
            $response->redirect('/libro'); //Retornar al index formato
            return $response;
        }     
    }

}