<?php

use App\Models\Users;
use App\Models\Reservas;
use App\Models\Prestamos;
use App\Models\Unidades;
use Carbon\Carbon;
use App\Models\Materialesbibliograficos;

class HistorialController extends \Phalcon\Mvc\Controller
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
    public function reservadoAction()
    {
        $reservas=Reservas::find('cancelado =false and idprestamista='.$this->user->prestamistas[0]->id);
        $this->view->pick("historial/reservados");
        $this->view->reservas=$reservas;
    }

    public function cancelarAction()
    {
        $id=$this->dispatcher->getParam('id');
        $reserva=Reservas::findFirst($id);
        $reserva->cancelado=true;
        $unidadesAfectadas=Unidades::findFirst('idmaterial ='.$reserva->idmaterial);
        $unidadesAfectadas->unidadesreservadas=$unidadesAfectadas->unidadesreservadas-1;
        $unidadesAfectadas->save();
        $reserva->save();
        $this->flashSession->success('La reserva fue cancelada');
        $this->response->redirect('/reservados');
    }

    public function prestamoAction()
    {
        $prestamos=Prestamos::find('devuelto =false and idprestamista='.$this->user->prestamistas[0]->id);        
        $this->view->pick("historial/prestados");
        $this->view->prestamos=$prestamos;
    }

    public function historialAction()
    {
        $prestamos=Prestamos::find('idprestamista='.$this->user->prestamistas[0]->id)->toArray();        
        $i=0;
       
        foreach ($prestamos as $prestamo) 
        {
            
            $prestamos[$i]['diasatrasados']=Carbon::parse($prestamo['fechadevolucion'])
            ->diffInDays(carbon::now());
            $prestamos[$i]['nombre']=Materialesbibliograficos::findFirst($prestamo['idmaterial'])->nombre;
            $prestamos[$i]['procesado']= (Carbon::now() < Carbon::parse($prestamo['fechadevolucion']));
            $i++;
        }
         var_dump($prestamos);
//$this->view->disable();       
        $this->view->pick("historial/historial");
        $this->view->prestamos=$prestamos;
    }
}

