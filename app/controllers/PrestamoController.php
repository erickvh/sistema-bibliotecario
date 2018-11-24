<?php

use App\Models\Reservas;
use App\Models\Prestamos;
use App\Models\Unidades;
use App\Models\Users;
use Phalcon\Http\Response;
use Carbon\Carbon;

class PrestamoController extends \Phalcon\Mvc\Controller
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
        if($this->biblioteca){
            $reservasGen=Reservas::find('prestado=false and cancelado=false');
            $reservas=[];
            $i=0;
            foreach ($reservasGen as $reserva) {
                if($reserva->prestamistas->bibliotecas->id==$this->biblioteca->id)
                {  
                    $reservas[$i]= $reserva;
                    ++$i;
                }
            }
        }
        
        $this->view->pick('prestamo/consultarReservas');
        $this->view->reservas=$reservas;

    }

    public function prestarAction()
    {
        $this->view->pick('prestamo/prestar');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $reserva = Reservas::findFirst($id);
        $fechadevolucion=Carbon::now()->addDay(3)->format('d-m-Y');
        $hoy=Carbon::now()->format('Y-m-d');
        $this->view->reserva = $reserva;
        $this->view->fechadevolucion=$fechadevolucion;
        $this->view->hoy=$hoy;
        if ($this->request->isPost()) {
            $reserva->prestado='true';
            $reserva->save();
            $prestamo = new Prestamos;
            $prestamo->idmaterial=$reserva->idmaterial;
            $prestamo->idprestamista=$reserva->idprestamista;
            $prestamo->devuelto='false';
            $prestamo->diasatrasado=0;
            $prestamo->fechaprestamo=Carbon::now()->format('Y-m-d');
            $prestamo->fechadevolucion=Carbon::now()->addDay(3)->format('Y-m-d');
            $prestamo->save();
            $unidades=Unidades::findFirst("idmaterial='".$reserva->idmaterial."'");
            $unidades->unidadesprestadas=$unidades->unidadesprestadas+1;
            $unidades->unidadesreservadas=$unidades->unidadesreservadas-1;
            $unidades->save();
            $response = new Response();
            $this->flashSession->success('Préstamo realizado con éxito');
            $response->redirect('/reserva'); //Retornar al index
            return $response;
        }     
    }

    public function cancelarReservaAction()
    {
        $this->view->pick('prestamo/cancelarReserva');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $reserva = Reservas::findFirst($id);
        $this->view->reserva = $reserva;
        if ($this->request->isPost()) {
            $reserva->cancelado='true';
            $reserva->save();
            $unidades=Unidades::findFirst("idmaterial='".$reserva->idmaterial."'");
            $unidades->unidadesreservadas=$unidades->unidadesreservadas-1;
            $unidades->save();
            $response = new Response();
            $this->flashSession->success('Reserva cancelada');
            $response->redirect('/reserva'); //Retornar al index
            return $response;
        }     
    }

    public function consultarPrestamosAction()
    {
        if($this->biblioteca){
            $prestamosGen=Prestamos::find('devuelto=false');
            $prestamos=[];
            $i=0;
            foreach ($prestamosGen as $prestamo) {
                if($prestamo->prestamistas->bibliotecas->id==$this->biblioteca->id)
                {  
                    $prestamos[$i]= $prestamo;
                    ++$i;
                }
            }
        }
        $this->view->pick('prestamo/consultarPrestamos');
        $this->view->prestamos=$prestamos;

    }

    public function devolverAction()
    {
        $this->view->pick('prestamo/devolver');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $prestamo = Prestamos::findFirst($id);
        $this->view->prestamo = $prestamo;
        if ($this->request->isPost()) {
            $prestamo->devuelto='true';
            $fechadevolucion=Carbon::parse($prestamo->fechadevolucion);
            $fechahoy=Carbon::now();
            if ($fechahoy > $fechadevolucion){
                $prestamo->diasatrasado=$fechahoy->diffInDays($fechadevolucion);
            }
            $prestamo->save();
            $unidades=Unidades::findFirst("idmaterial='".$prestamo->idmaterial."'");
            $unidades->unidadesprestadas=$unidades->unidadesprestadas-1;
            $unidades->save();
            $response = new Response();
            $this->flashSession->success('Devolución realizada con éxito');
            $response->redirect('/prestamo'); //Retornar al index
            return $response;
        }     
    }
}