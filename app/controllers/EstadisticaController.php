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
        $categorias = Categorias::find("idbiblioteca ='".$this->biblioteca->id."'");
        $this->view->categorias = $categorias;
    }

    public function categoriaAction()
    {
        if ($this->request->getMethod(GET)) 
        {              
        $fechaInicial = $this->request->get('fecha_inicio');
        $fechaFinal = $this->request->get('fecha_fin');                            
        $this->view->pick('estadistica/categorias');        
        /* Arreglos a utilizar para graficar */       
        $nomCategorias = array();
        $cantidad = array();   
        /* Consulta SQL para los prestamos y graficar entre las fechas*/         
        $sql="select categorias.nombre, count(*)  from Categorias inner join subcategorias on categorias.id = subcategorias.idcategoria 
        inner join materialesbibliograficos on materialesbibliograficos.idsubcategoria = subcategorias.id 
        inner join prestamos on prestamos.idmaterial = materialesbibliograficos.id 
        WHERE categorias.idbiblioteca ='".$this->biblioteca->id."'AND prestamos.fechaprestamo BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' group by categorias.nombre order by count(*) desc FETCH FIRST 5 ROWS ONLY";
        $db = \Phalcon\Di::getDefault()->get('db');
        $datos = $db->fetchAll($sql);        
        foreach($datos as $dato)
        {
            array_push($nomCategorias, $dato['nombre']);
            array_push($cantidad, $dato['count']);            
        }        
        $this->view->fecha_inicio = $fechaInicial;
        $this->view->fecha_fin = $fechaFinal;
        $this->view->cantidad = $cantidad; 
        $this->view->cat = $nomCategorias;
        }
        else
        {
            $this->view->pick('estadistica/categorias');
        }
    }

    public function subcategoriaAction()
    {
        if ($this->request->getMethod(GET)) 
        {              
        $fechaInicial = $this->request->get('fecha_inicio');
        $fechaFinal = $this->request->get('fecha_fin');
        $id_categoria = $this->request->get('id_categoria');                           
        $this->view->pick('estadistica/subcategoria');        
        /* Arreglos a utilizar para graficar */       
        $nomSubCategorias = array();
        $cantidad = array();   
        /* Consulta SQL para los prestamos y graficar entre las fechas*/         
        $sql="select subcategorias.nombre, count(*)  from Categorias inner join subcategorias on categorias.id = subcategorias.idcategoria 
        inner join materialesbibliograficos on materialesbibliograficos.idsubcategoria = subcategorias.id 
        inner join prestamos on prestamos.idmaterial = materialesbibliograficos.id 
        WHERE categorias.idbiblioteca ='".$this->biblioteca->id."'AND subcategorias.idcategoria ='".$id_categoria."' AND prestamos.fechaprestamo BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' group by subcategorias.nombre order by count(*) desc FETCH FIRST 5 ROWS ONLY";
        $db = \Phalcon\Di::getDefault()->get('db');
        $datos = $db->fetchAll($sql);        
        foreach($datos as $dato)
        {
            array_push($nomSubCategorias, $dato['nombre']);
            array_push($cantidad, $dato['count']);            
        }        
        $this->view->fecha_inicio = $fechaInicial;
        $this->view->fecha_fin = $fechaFinal;
        $this->view->cantidad = $cantidad; 
        $this->view->subcat = $nomSubCategorias;
        }
        else
        {
            $this->view->pick('estadistica/categorias');
        }
    }

    public function librosAction()
    {
        if ($this->request->getMethod(GET)) 
        {  
        $fechaInicial = $this->request->get('fecha_inicio');
        $fechaFinal = $this->request->get('fecha_fin');
        $id_categoria = $this->request->get('id_categoria');                           
        $this->view->pick('estadistica/libromasleido');        
        /* Arreglos a utilizar para graficar */       
        $nomLibros = array();
        $cantidad = array();   
        /* Consulta SQL para los prestamos y graficar entre las fechas*/         
        $sql="select materialesbibliograficos.nombre, count(*)  from prestamos
        inner join materialesbibliograficos on prestamos.idmaterial = materialesbibliograficos.id 
        inner join libros on materialesbibliograficos.id = libros.idmaterial
        WHERE materialesbibliograficos.idbiblioteca ='".$this->biblioteca->id."'
        AND prestamos.fechaprestamo BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' group by materialesbibliograficos.nombre order by count(*) desc FETCH FIRST 5 ROWS ONLY";
        $db = \Phalcon\Di::getDefault()->get('db');
        $datos = $db->fetchAll($sql);        
        foreach($datos as $dato)
        {
            array_push($nomLibros, $dato['nombre']);
            array_push($cantidad, $dato['count']);            
        }
        $this->view->fecha_inicio = $fechaInicial;
        $this->view->fecha_fin = $fechaFinal;
        $this->view->cantidad = $cantidad; 
        $this->view->lib = $nomLibros;
        }
        else{
            $this->view->pick('estadistica/libromasleido'); 
        }
    }

    public function zonaAction()
    {
        if ($this->request->getMethod(GET)) 
        {  
        $fechaInicial = $this->request->get('fecha_inicio');
        $fechaFinal = $this->request->get('fecha_fin');
        $id_categoria = $this->request->get('id_categoria');                           
        $this->view->pick('estadistica/zonageografica');        
        /* Arreglos a utilizar para graficar */       
        $nomDep = array();
        $cantidad = array();   
        /* Consulta SQL para los prestamos y graficar entre las fechas*/         
        $sql="select departamentos.nombre, count(*) from departamentos inner join municipios on municipios.iddepartamento = departamentos.id
        inner join prestamistas on prestamistas.idmunicipio = municipios.id 
        inner join prestamos on prestamos.idprestamista = prestamistas.id
        where prestamistas.idbibilioteca ='".$this->biblioteca->id."' AND prestamos.fechaprestamo BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' group by departamentos.nombre order by count(*) desc";
        $db = \Phalcon\Di::getDefault()->get('db');
        $datos = $db->fetchAll($sql);        
        foreach($datos as $dato)
        {
            array_push($nomDep, $dato['nombre']);
            array_push($cantidad, $dato['count']);            
        }
        $this->view->fecha_inicio = $fechaInicial;
        $this->view->fecha_fin = $fechaFinal;
        $this->view->cantidad = $cantidad; 
        $this->view->dep = $nomDep;
        }
        else{
            $this->view->pick('estadistica/zonageografica'); 
        }
    }

}

