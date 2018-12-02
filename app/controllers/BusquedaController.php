<?php

use App\Models\Users;
use App\Models\Libros;
use App\Models\Recursos;
use App\Models\Unidades;
use App\Models\MaterialesAutores;
use App\Models\Reservas;
use App\Models\Prestamos;
use App\Models\Prestamistas;
use App\Models\Materialesbibliograficos;
use Phalcon\Http\Response;
use Carbon\Carbon;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Models\Formatos;

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

    public function indexAction(){
        $this->view->pick('busqueda/busqueda');
    }

    public function busquedaAction()
    {
        //if ($this->request->isPost()) {
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
        //}
        //else{
            //$this->view->pick('busqueda/busqueda');
        //}

    }

    public function verLibroAction(){
        
        $this->view->pick('busqueda/verLibro');
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $libro = Libros::findFirst($id);
        $unidades=Unidades::findFirst("idmaterial='".$libro->idmaterial."'");
        $unidadesDisp=$unidades->unidadesexistentes-($unidades->unidadesreservadas+$unidades->unidadesprestadas);
        $materialesautores=MaterialesAutores::find("idmaterial='".$libro->idmaterial."'");
        
        $diasHabiles=1;
        $prestamista = Prestamistas::findFirst("iduser='".$this->user->id."'");
        $reservas= Reservas::count("prestado=false and cancelado=false and idprestamista='".$prestamista->id."'");
        $prestamos= Prestamos::count("devuelto=false and idprestamista='".$prestamista->id."'");
        $total=$reservas+$prestamos;
        $this->view->limite = Carbon::now()->addDay($diasHabiles)->format('d-m-Y');
        $this->view->total = $total;

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

        $diasHabiles=1;
        $prestamista = Prestamistas::findFirst("iduser='".$this->user->id."'");
        $reservas= Reservas::count("prestado=false and cancelado=false and idprestamista='".$prestamista->id."'");
        $prestamos= Prestamos::count("devuelto=false and idprestamista='".$prestamista->id."'");
        $total=$reservas+$prestamos;
        $this->view->limite = Carbon::now()->addDay($diasHabiles)->format('d-m-Y');
        $this->view->total = $total;

        $this->view->recurso= $recurso;
        $this->view->unidades= $unidadesDisp;
        $this->view->matauts= $materialesautores;
    }

    public function reservarAction()
    {

        $this->view->disable();
        $diasHabiles=1;
        $id = $this->dispatcher->getParam('id'); //Obtener el parametros de la Url
        $material = Materialesbibliograficos::findFirst($id);
        $prestamista = Prestamistas::findFirst("iduser='".$this->user->id."'");
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
            $this->flashSession->success('Reservación del material "'.$material->nombre.'" realizada con exito');
            $this->response->redirect('busqueda'); //Retornar al index
    }
    
    function searchformAction(){
        $categorias=Categorias::find("idbiblioteca=".$this->biblioteca->id); 
        $formatos=Formatos::find("idbiblioteca=".$this->biblioteca->id);
        $this->view->pick('busqueda/busqueda-avanzada');
        $this->view->categorias=$categorias;
        $this->view->tipos=$formatos;
    }

    function subcategoriesAction(){
        $this->view->disable();
        $Subcategorias=Subcategorias::find('idcategoria='.$this->request->get('id'));
        $response = new Response;
        $response->setContent(json_encode($Subcategorias));
        return $response;
    }


    function searchAction(){
        $titulo=$this->request->get('titulo');
        $categoria=$this->request->get('categoria');
        $subcategoria=$this->request->get('subcategoria');
        $recurso=$this->request->get('recurso');

        $this->view->pick('busqueda/resultados-avanzados');// this view support both articles
        
        //this query it's going to work with all the resources
        $sql="select mat.nombre  as nombre, mat.imagenurl as url, mat.fechapublicacion as fecha, mat.id as id, 
        libros.sinopsis, rec.idformato, form.tipoformato as tipo, rec.id as recursoid,libros.id as libroid, libros.editorial as editorial
        from materialesbibliograficos as mat inner join subcategorias as sub on mat.idsubcategoria=sub.id
        inner join categorias as cat on cat.id=sub.idcategoria left join libros on libros.idmaterial = mat.id 
        left join recursos as rec on rec.idmaterial=mat.id left join formatos as form on form.id = rec.idformato
          where cat.idbiblioteca=".$this->biblioteca->id;
        
      $db = \Phalcon\Di::getDefault()->get('db');
     
        if($titulo)
        {
            $sql.=" and mat.nombre ilike '%".$titulo."%'";
        }
        
        if($categoria){

            if(Categorias::findFirst($categoria)&&Categorias::findFirst($categoria)->
            idbiblioteca!=$this->biblioteca->id)
            {
                $this->flashSession->warning('Esta subcategoria no pertenece a esta biblioteca');
                return $this->response->redirect('/busqueda-avanzada');
            }
            $sql.=" and cat.id = ".$categoria;

        }
        
        if($subcategoria)
        {

            if(Subcategorias::findFirst($subcategoria)->idcategoria!=$categoria){
                $this->flashSession->warning('Esta subcategoria no pertenece a esta categoria');
                return $this->response->redirect('/busqueda-avanzada');
            }
            $sql.=" and sub.id = ".$subcategoria;

        }


        if($recurso)
        {
            //ternary operator is gonna create the sentence with the full filter
            $sql= 
            $recurso=='libro'? 
            "select mat.nombre  as nombre, mat.imagenurl as url, mat.fechapublicacion as fecha, mat.id as id, 
            libros.sinopsis, libros.editorial, libros.id as libroid
            from materialesbibliograficos as mat inner join subcategorias as sub on mat.idsubcategoria=sub.id
            inner join categorias as cat on cat.id=sub.idcategoria right join libros on libros.idmaterial = mat.id  where cat.idbiblioteca=".$this->biblioteca->id            
            :
            "
            select mat.nombre  as nombre, mat.imagenurl as url, mat.fechapublicacion as fecha, mat.id as id, 
            rec.idformato, form.tipoformato as tipo, rec.id as recursoid
            from materialesbibliograficos as mat inner join subcategorias as sub on mat.idsubcategoria=sub.id
            inner join categorias as cat on cat.id=sub.idcategoria  
            left join recursos as rec on rec.idmaterial=mat.id inner join formatos as form on form.id = rec.idformato
            where cat.idbiblioteca=".$this->biblioteca->id;
            //si es libro, desplegara su vista respectiva y caso contrario si es recurso            
            $recurso=='libro'?
            $this->view->pick('busqueda/resultados-avanzados-lib'):$this->view->pick('busqueda/resultados-avanzados-rec');

              if($titulo)
              {
                  $sql.=" and mat.nombre ilike '%".$titulo."%'";
              }
              

              if($categoria){


      
                  if(Categorias::findFirst($categoria)&&Categorias::findFirst($categoria)->
                  idbiblioteca!=$this->biblioteca->id)
                  {
                      $this->flashSession->warning('Esta subcategoria no pertenece a esta biblioteca');
                      return $this->response->redirect('/busqueda-avanzada');
                  }
                  $sql.=" and cat.id = ".$categoria;
      
              }
              
              if($subcategoria)
              {
      
                  if(Subcategorias::findFirst($subcategoria)->idcategoria!=$categoria){
                      $this->flashSession->warning('Esta subcategoria no pertenece a esta categoria');
                      return $this->response->redirect('/busqueda-avanzada');
                  }
                  $sql.=" and sub.id = ".$subcategoria;
      
              }
              
              if($recurso&&$recurso!="libro"){

                $sql.=" and form.id =".$recurso;
              }
        }

      
//obtiene finalmente los datos, de los filtros
        $datos = $db->fetchAll($sql);      
        //prepara sql para autores
        $sqlAutores='select aut.nombre as nombre from materialesbibliograficos as mat inner join materiales_autores as mat_aut 
        on mat.id=mat_aut.idmaterial inner join autores as aut on mat_aut.idautor = aut.id where mat.id=';
        $i=0;
        // hace foreach de todos los materiales encontrados
        foreach ($datos as $idmat) 
        {
            //obtienen los autores por id material
            $dataAutores=$db->fetchAll($sqlAutores.$idmat['id']);
            //prepara seccion array para autores, donde i es el indice del material
            $datos[$i]['autores']=[];
            // de los autores obtenidos los itera y los inserta en el array preparado
            foreach ($dataAutores as $dataAutor )
                 array_push($datos[$i]['autores'],$dataAutor["nombre"]);
        
                 $i++;
        }

       //$this->view->disable();
        var_dump($datos);
        $this->view->respuestas=  $datos ;

    }
} //end of the controller
