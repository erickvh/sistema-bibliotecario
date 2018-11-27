{% extends 'layouts/prestamista.volt' %}
{% block titulo %} Reservados
{% endblock %}
{% block iconActual%}
<h1><i class="fa fa-user-circle"></i> Prestamos </h1>
<p>Sección de prestamos </p>
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
                <table id="tabFormato" class="table table-bordered">
                    <thead class="bg-primary">
                        <th>En reserva</th>
                        <th>Fecha de prestamo</th>
                        <th>Fecha de vencimiento de prestamo</th>
                        <th>Dias Atrasados</th>

                    </thead>
                    <tbody>
                        {% for prestamo in prestamos %}
                        <tr>
                            <td>{{prestamo["nombre"]}}</td>
                            <td>{{prestamo["fechaprestamo"]}}</td>
                            <td>{{prestamo["fechadevolucion"]}}</td>
                            {% if prestamo['procesado'] %}
                                {% if prestamo["devuelto"] %}
                                    <td> entregado </td>
                                {% else %}
                                    <td> En periodo de prestamo </td>              
                                {% endif %}
                            {% else %}
                                {% if prestamo["devuelto"] %}
                                    <td> entregado </td>
                                {% else %}
                                    <td>{{prestamo["diasatrasados"]}}  </td>
                                {% endif %}
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
<script type="text/javascript">
$('#tabFormato').DataTable({
    'language': {
        'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
    }
});
</script>
{% endblock %}