<?php

use App\Models\Users;
use App\Models\Libros;
use App\Models\Recursos;
use App\Models\Unidades;
use App\Models\MaterialesAutores;
use App\Models\Reservas;
use App\Models\Prestamos;
use App\Models\Prestamistas;
use App\Models\MaterialesBibliograficos;
use Phalcon\Http\Response;
use Carbon\Carbon;

class BusquedaController extends \Phalcon\Mvc\Controller
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
                case 'Bibliotecario':
                $this->response->redirect('/401');
                break;
                case 'Prestamista':
                $this->biblioteca=$this->user->prestamistas[0]->bibliotecas; 
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
        if ($this->request->isPost()) {
            $busqueda = $this->request->get('busqueda');
            $formaBuscar= $this->request->get('formaBuscar');

            if($this->biblioteca){
                $matautGen=MaterialesAutores::find();
                $matautoresGen=[];
                $i=0;
                foreach ($matautGen as $mataut) {
                    if($mataut->materialesbibliograficos->bibliotecas->id==$this->biblioteca->id)
                    {  
                        $matautoresGen[$i]= $mataut;
                        ++$i;
                    }
                }
            }

            if($formaBuscar=='otros'){
                if($this->biblioteca){
                    $recursosGen=Recursos::find();
                    $recursos=[];
                    $i=0;
                    foreach ($recursosGen as $recurso) {
                        if($recurso->materialesbibliograficos->bibliotecas->id==$this->biblioteca->id and stripos($recurso->materialesbibliograficos->nombre,$busqueda)!==false)
                        {  
                            $recursos[$i]= $recurso;
                            ++$i;
                        }
                    }
                } 
                $this->view->pick('busqueda/resultadosRecursos');  
                $this->view->recursos= $recursos;
                $this->view->matautores= $matautoresGen;
            }
            else{

                $this->view->pick('busqueda/resultadosLibros');

                if($formaBuscar=='autor'){
                    if($this->biblioteca){
                        $librosGen=Libros::find();
                        $libros=[];
                        $matautores=[];
                        $i=0;
                        foreach ($librosGen as $libro) {
                            $materialesautores=MaterialesAutores::find("idmaterial='".$libro->idmaterial."'");
                            foreach ($materialesautores as $mataut){
                                if($libro->materialesbibliograficos->bibliotecas->id==$this->biblioteca->id and stripos($mataut->autores->nombre,$busqueda)!==false)
                                {  
                                    $libros[$i]= $libro;
                                    ++$i;
                                }
                            }
                        }
                    }   
                }
                if($formaBuscar=='titulo'){
                    if($this->biblioteca){
                        $librosGen=Libros::find();
                        $libros=[];
                        $i=0;
                        foreach ($librosGen as $libro) {
                            if($libro->materialesbibliograficos->bibliotecas->id==$this->biblioteca->id and stripos($libro->materialesbibliograficos->nombre,$busqueda)!==false)
                            {  
                                $libros[$i]= $libro;
                                ++$i;
                            }
                        }
                    }   
                }
                if($formaBuscar=='isbn'){
                    if($this->biblioteca){
                        $librosGen=Libros::find();
                        $libros=[];
                        $i=0;
                        foreach ($librosGen as $libro) {
                            if($libro->materialesbibliograficos->bibliotecas->id==$this->biblioteca->id and strcasecmp($libro->isbn,$busqueda)===0)
                            {  
                                $libros[$i]= $libro;
                                ++$i;
                            }
                        }
                    }   
                }
                $this->view->libros= $libros;
                $this->view->matautores= $matautoresGen;
            }
        }
        else{
            $this->view->pick('busqueda/busqueda');
        }

    }

    public function verLibroAction(){
        
        $this->view->pick('busqueda/verLibro');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $libro = Libros::findFirst($id);
        $unidades=Unidades::findFirst("idmaterial='".$libro->idmaterial."'");
        $unidadesDisp=$unidades->unidadesexistentes-($unidades->unidadesreservadas+$unidades->unidadesprestadas);
        $materialesautores=MaterialesAutores::find("idmaterial='".$libro->idmaterial."'");
        $this->view->libro= $libro;
        $this->view->unidades= $unidadesDisp;
        $this->view->matauts= $materialesautores;
    }

    public function verRecursoAction(){
        
        $this->view->pick('busqueda/verRecurso');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $recurso = Recursos::findFirst($id);
        $unidades=Unidades::findFirst("idmaterial='".$recurso->idmaterial."'");
        $unidadesDisp=$unidades->unidadesexistentes-($unidades->unidadesreservadas+$unidades->unidadesprestadas);
        $materialesautores=MaterialesAutores::find("idmaterial='".$recurso->idmaterial."'");
        $this->view->recurso= $recurso;
        $this->view->unidades= $unidadesDisp;
        $this->view->matauts= $materialesautores;
    }

    public function reservarAction()
    {
        $this->view->pick('busqueda/reservar');
        $diasHabiles=1;
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $material = MaterialesBibliograficos::findFirst($id);
        $prestamista = Prestamistas::findFirst("iduser='".$this->user->id."'");
        $reservas= Reservas::count("prestado=false and cancelado=false and idprestamista='".$prestamista->id."'");
        $prestamos= Prestamos::count("devuelto=false and idprestamista='".$prestamista->id."'");
        $total=$reservas+$prestamos;
        $this->view->material = $material;
        $this->view->total = $total;
        $this->view->limite = Carbon::now()->addDay($diasHabiles)->format('d-m-Y');
        if ($this->request->isPost()) {
            $reserva=new Reservas;
            $reserva->fechasolicitud=Carbon::now()->format('Y-m-d');
            $reserva->fechareserva=Carbon::now()->addDay($diasHabiles)->format('Y-m-d');
            $reserva->prestado='false';
            $reserva->cancelado='false';
            $reserva->idmaterial=$material->id;
            $reserva->idprestamista=$prestamista->id;
            $reserva->save();
            $unidades=Unidades::findFirst("idmaterial='".$reserva->idmaterial."'");
            $unidades->unidadesreservadas=$unidades->unidadesreservadas+1;
            $unidades->save();
            $response = new Response();
            $this->flashSession->success('Reservación del material "'.$material->nombre.'" realizada con exito');
            $response->redirect('/busqueda'); //Retornar al index
            return $response;
        }     
    }
    
}
