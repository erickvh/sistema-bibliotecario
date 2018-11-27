{% extends "layouts/bibliotecario.volt" %}

{%  block titulo %} Lectores {% endblock %}

{% block iconActual %}
<h1><i class="fa fa-users"></i> Lectores </h1>
<p>Sección de gestion de lectores</p>
{% endblock %} 

{% block contenido %}
<br>
                      
<table class="table table-hover table-bordered" id="sampleTable">
   <thead class="bg-primary">
      <tr>
        <th>Usuario</th>
        <th>Nombre</th>
   <!--     <th>Apellido</th> -->
        <th>Lugar de estudio</th>
        <th>Estado</th>
        <th width="28%">Acción</th>
      </tr>
   </thead>
   <tbody>
      {% for prestamist in prestamistas %}
      
      <tr>
        <td> {{ prestamist.users.username}} </td>
        <td> {{ prestamist.users.nombre}} </td>
     <!--   <td> {{ prestamist.users.nombre}} </td> -->
        <td> {{ prestamist.lugardeestudio}} </td>
      {% if prestamist.activo == 1 %}  
        <td> activo </td>
        {% else %}
        <td> Inactivo </td>
      {% endif %}
      {% if prestamist.activo %}
      <td>
          <a href="{{url('lector/editar/'~ prestamist.id)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>
          <a href="{{url('lector/ver/'~ prestamist.id)}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> Ver </a>
          <a onclick="return abrir_modal('{{url('lector/deshabilitar/'~ prestamist.id)}}')" class="btn btn-warning"><i class="fa fa-lock" aria-hidden="true"></i>Deshabilitar</a>
      </td>
      {% else %}
      <td>
          <a onclick="return abrir_modal('{{url('lector/deshabilitar/'~ prestamist.id)}}')" class="btn btn-success"><i class="fa fa-unlock" aria-hidden="true"></i>Habilitar</a>
      </td>
      {% endif %}
      </tr>
       
      {% endfor %}
   </tbody>
</table>

<a type="button" class="btn btn-primary" href="lector/crear" >
  <i class="fa fa-plus-circle" aria-hidden="true"></i>
  Agregar Lector
</a>

<!-- Modal deshabilitar -->
<div id="popup" class="modal fade" role="dialog">
  </div>

{% endblock %}

{% block extraJS %}
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable({'language': {'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'}});</script>
<script type="text/javascript">
  var modal;
</script>

<script type="text/javascript">
var modal;

function abrir_modal(url) {
    $('#popup').load(url, function() {
        $(this).modal('show');
    });
    return false;
}

function cerrar_modal() {
    $('#popup').modal('hide');
    return false;
}
</script>
{% endblock %}