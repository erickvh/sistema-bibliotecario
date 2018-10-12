{% extends "layouts/bibliotecario.volt" %}

{%  block titulo %} Libro {% endblock %}

{% block iconActual %}
<h1><i class="fa fa-book"></i> Libros </h1>
<p>Sección de gestion de libros</p>
{% endblock %} 


{% block contenido %}
  <div style="padding-left: 90%;">
    <a type="button" class="btn btn-primary" href="libro/crear" >
      <i class="fa fa-plus-circle" aria-hidden="true"></i>
      Agregar
    </a>
  </div>
  <br>
                      
  <table class="table table-hover table-bordered" id="sampleTable">
     <thead class="bg-primary">
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Fecha de publicación</th>
          <th>Editorial</th>
          <th>Subcategoria</th>
          <th width="21%">Acción</th>
        </tr>
     </thead>
     <tbody>
        {% for libro in libros %}
         {% if bib == libro.Materialesbibliograficos.idbiblioteca %}
          <tr>
            <td>{{ libro.Materialesbibliograficos.nombre }}</td>
            <td>{{ libro.Materialesbibliograficos.descripcion }}</td>
            <td>{{ libro.Materialesbibliograficos.fechapublicacion}}</td>
            <td>{{ libro.editorial}}</td>
            <td>{{ libro.Materialesbibliograficos.Subcategorias.nombre}}</td>
            <td>
              <a href="{{url('libro/editar/'~ libro.id)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>
              <a onclick="return abrir_modal('{{url('libro/eliminar/'~ libro.id)}}')" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
            </td>
          </tr>
         {% endif %}
        {% endfor %}
      </tbody>
    </table>
      
    <!-- Modal Eliminar -->
<div id="eliminarLibro" class="modal fade" role="dialog">
</div>

{% endblock %}

{% block extraJS %}
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable({'language': {'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'}});</script>
<script type="text/javascript">
  var modal;
  
  function abrir_modal(url) {
      $('#eliminarLibro').load(url, function() {
          $(this).modal('show');
      });
      return false;
  }
  
  function cerrar_modal() {
      $('#eliminarLibro').modal('hide');
      return false;
  }
  </script>
{% endblock %}