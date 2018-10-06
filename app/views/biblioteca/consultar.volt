{% extends "layouts/admin.volt" %}

 {% block iconActual %}
<h1><i class="fa fa-th-list"></i>Bibliotecas</h1>
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
          <th>Ubicación</th>
          <th>Télefono</th>
          <th>Clasificación</th>
          <th>Email</th>
        </tr>
     </thead>
     <tbody>
        {% for biblioteca in bibliotecas %}
          <tr>
            <td>{{ biblioteca.nombre}}</td>
            <td>{{ biblioteca.ubicacion}}</td>
            <td>{{ biblioteca.telefono}}</td>
            <td>{{ biblioteca.clasificacion}}</td>
            <td>{{ biblioteca.email}}</td>
          </tr>
        {% endfor %}
      </tbody>
    </table>
        

{% endblock %}

{% block extraJS %}
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable({'language': {'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'}});</script>
{% endblock %}