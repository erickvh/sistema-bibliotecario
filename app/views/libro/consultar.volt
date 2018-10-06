{% extends "layouts/bibliotecario.volt" %}

 {% block iconActual %}
<h1><i class="fa fa-th-list"></i>Libros</h1>
<p></p>
{% endblock %}


{% block contenido %}
  <div style="padding-left: 97%;">
    <a href="#" ><i class="fa fa-plus fa-lg" style="font-size:200%;"></i></a>
  </div>
  <br>
                      
  <table class="table table-hover table-bordered" id="sampleTable">
     <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Fecha de publicación</th>
          <th>Volumen</th>
          <th>Editorial</th>
          <th>Sinopsis</th>
          <th>Subcategoria</th>
        </tr>
     </thead>
     <tbody>
        {% for libro in libros %}
         {% if bib == libro.Materialesbibliograficos.idbiblioteca %}
          <tr>
            <td>{{ libro.Materialesbibliograficos.nombre }}</td>
            <td>{{ libro.Materialesbibliograficos.descripcion }}</td>
            <td>{{ libro.Materialesbibliograficos.fechapublicacion}}</td>
            <td>{{ libro.volumen}}</td>
            <td>{{ libro.editorial}}</td>
            <td>{{ libro.sinopsis}}</td>
            <td>{{ libro.Materialesbibliograficos.Subcategorias.nombre}}</td>
          </tr>
         {% endif %}
        {% endfor %}
      </tbody>
    </table>
        

{% endblock %}

{% block extraJS %}
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable({'language': {'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'}});</script>
{% endblock %}