<?php
use App\Models\Recursos;
use App\Models\Materialesbibliograficos;
use App\Models\Subcategorias;
use App\Models\Categorias;
use Phalcon\Http\Response;
use App\Models\Users;
use App\Models\Prestamos;
class EstadisticaController extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
        
        if($this->session->has('id'))
        {  

            //crea la busqueda si existe id
        $this->idSesion = $this->session->get('id');
        $this->user=Users::findFirst($this->idSesion);
        $this->rol=$this->user->roles->nombre;
        
        // redirige si el rol cargado es diferente
            switch($this->rol)
            {
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
        $this->view->pick('estadistica/index');
        if ($this->request->isPost()) 
        {

        }
    }

    public function categoriaAction()
    {
        $anio = $this->dispatcher->getParam('anio');
        $mes1 = $this->dispatcher->getParam('mes_inicial');
        $mes2 = $this->dispatcher->getParam('mes_final');
        $fechaInicial = "".$anio."-".$mes1."-01";
        $fechaFinal = "".$anio."-".$mes2."-01";        
        $this->view->pick('estadistica/graficas');
        $subcategorias = Subcategorias::find(['order'=>'nombre']);
        $categorias = Categorias::find("idbiblioteca ='".$this->biblioteca->id."'");
        /* Arreglos a utilizar para graficar */
        $subcat = array();
        $numRecurso = array();
        $nomCategorias = array();
        $cantidad = array();   
        /* Falta anidarle las fechas*/         
        $sql="select categorias.nombre, count(*)  from Categorias inner join subcategorias on categorias.id = subcategorias.idcategoria 
        inner join materialesbibliograficos on materialesbibliograficos.idsubcategoria = subcategorias.id 
        inner join prestamos on prestamos.idmaterial = materialesbibliograficos.id 
        WHERE categorias.idbiblioteca ='".$this->biblioteca->id."'AND prestamos.fechaprestamo BETWEEN '2018-10-16' AND '2018-11-18' group by categorias.nombre order by count(*) desc";
        $db = \Phalcon\Di::getDefault()->get('db');
        $datos = $db->fetchAll($sql);
        $i=0;
        foreach($datos as $dato)
        {
            array_push($nomCategorias, $dato['nombre']); 
            array_push($cantidad, $dato['count']);
            $i++;
            if($i==5)
            {
                break;
            }
        }
        $this->view->cantidad = $cantidad; 
        $this->view->cat = $nomCategorias;
    }

}

