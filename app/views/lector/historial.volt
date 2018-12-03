{% extends "layouts/bibliotecario.volt" %}

{%  block titulo %} Historial de uso {% endblock %}

{% block iconActual %}
<h1><i class="fa fa-book"></i> Historial de uso </h1>
<p>Sección para monitorear el uso del del material bibliografico por los lectores</p>
{% endblock %} 

{% block extraCSS %}
<style>
    table th {
        text-align: center;
    }
    
    table tr {
        text-align: center;
    }
</style>
{% endblock %}

{% block contenido %}
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead class="bg-primary">
                        <th>Prestamista</th>
                        <th>Usuario</th>
                        <th>Material Bibliográfico</th>
                        <th>Fecha del prestamo</th>
                        <th>Fecha de devolución</th>
                        <th>dias de atraso</th>
                        <th>Material devuelto</th>
                    </thead>
                    <tbody>
                        {% for prestamo in prestamos %}
                        <tr>
                            <td> {{prestamo.Prestamistas.Users.nombre}}</td>
                            <td> {{prestamo.Prestamistas.Users.username}}</td>
                            <td> {{prestamo.MaterialesBibliograficos.nombre}}</td>
                            <td> {{prestamo.fechaprestamo}}</td>
                            <td> {{prestamo.fechadevolucion}}</td>
                            <td> {{prestamo.diasatrasado}}</td>
                            {% if prestamo.devuelto == 'true' %}
                            <td>Si </td>
                            {% else %}
                            <td>No</td>
                            {% endif %}
                            
                        </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



{% endblock %}
{% block extraJS %}
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable({'language': {'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'}});</script>

{% endblock %}