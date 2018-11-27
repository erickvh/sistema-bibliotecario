{% extends 'layouts/prestamista.volt' %}
{% block titulo %} Resultados
{% endblock %}
{% block iconActual%}
<h1><i class="fa fa-search"></i> Resultados de la búsqueda </h1>
{% endblock %}

{% block contenido %}
            <div class="container" style="padding-left: 15%; padding-right: 15%;"> 
            <div class="row">
                <div class="col col-md-12">
                <br>
                <h4 style="text-align: center;"><p >{{recurso.materialesbibliograficos.nombre}}</p></h4>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-3">
                <br>
                    {% if recurso.MaterialesBibliograficos.imagenurl %}
                        <img width="180px" height="180px" src='{{recurso.MaterialesBibliograficos.imagenurl}}' {{recurso.MaterialesBibliograficos.nombreimagen ? "alt='"~recurso.MaterialesBibliograficos.nombreimagen~"'":'no disponible'}} />
                    {% else %}
                        <img src='https://via.placeholder.com/180x180?text=No disponible' alt='logo no disponible'/> 
                    {% endif %}
                </div>
                <div class="col col-md-1"></div>
                <div class="col col-md-5">
                <br>
                    <?php $i=1 ?>
                    <p>Autor: {% for mataut in matauts %} {% if i!= 1 %} , {% endif %} <?php $i=$i+1?> {{mataut.autores.nombre}} {% endfor %}</p>
                    {% if recurso.materialesbibliograficos.fechapublicacion %}
                        <p>Fecha de publicación: {{recurso.materialesbibliograficos.fechapublicacion}}</p>
                    {% else %}
                        <p>Fecha de publicación: No definida</p>
                    {% endif %}
                    <p>Categoria: {{recurso.materialesbibliograficos.subcategorias.categorias.nombre}}</p>
                    <p>Formato: {{recurso.formatos.tipoformato}}</p>
                    <p style="font-weight: bold;">Unidades disponibles: {{unidades}}</p>
                </div>
                <div class="col col-md-1"></div>
                <div class="col col-md-1">
                    {% if unidades>0 %}
                    <br>
                    <!--<a onclick="return abrir_modal('{{url('busqueda/reservar/'~ recurso.materialesbibliograficos.id)}}')"  class="btn btn-success" ><i aria-hidden="true"></i> Reservar </a>-->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#reservarRecurso">
                            Reservar
                        </button>
                    {% endif %}
                </div>
            </div>
            <div class="row">
                    <div class="col col-md-9">
                    </div>
                    <div class="col col-md-1"></div>
                    <div class="col col-md-2">
                        <br>
                        <!--window.history.back()-->
                        <button class="btn btn-primary" onclick="javascript:window.history.back();">Regresar</button>
                    </div>
                </div>
            </div>
            <br>

                <!-- Modal reservar -->
            <div id="reservarRecurso" class="modal fade" role="dialog">
                    {% if total < 3 %}
                    <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmar Reservación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-lg-12">
                                        <p> ¿Desea reservar <strong>{{recurso.materialesbibliograficos.nombre}}</strong>?</p>
                                        <p>Tiene hasta el <strong>{{limite}}</strong> para realizar el préstamo</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-lg-12 text-right">
                                        <form role="form" action="{{url('busqueda/reservar/'~ recurso.materialesbibliograficos.id)}}" method="post">
                                            <input type="submit" class="btn btn-primary" id="despedir" value="Si">
                                            <button type="button" class="btn btn-secondary" onclick="return cerrar_modal()"> No </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {% else %}
                    <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Reservación Denegada</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-lg-12">
                                        <p> El maximo de recursos bibliograficos que puede prestar son 3 </p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-lg-12 text-right">
                                        <button type="button" class="btn btn-secondary" onclick="return cerrar_modal()"> Aceptar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {% endif %}
            </div>
{% endblock %}

{% block extraJS %}
<script type="text/javascript">
  var modal;
  
  function abrir_modal(url) {
      $('#reservarRecurso').load(url, function() {
          $(this).modal('show');
      });
      return false;
  }
  
  function cerrar_modal() {
      $('#reservarRecurso').modal('hide');
      return false;
  }
  </script>
{% endblock %}
