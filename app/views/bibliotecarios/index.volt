{% extends 'layouts/admin.volt' %}
{% block titulo %} bibliotecarios
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
{% block iconActual %}
<h1><i class="fa fa-users"></i> Bibliotecarios </h1>
<p>Sección para gestionar bibliotecarios</p>
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col">
            {{ flashSession.output() }}
                <table id="tabFormato" class="table table-bordered">
                    <thead class="bg-primary">
                        <th>Nombre</th>
                        <th>Username</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>

                        {% for bibliotecario in bibliotecarios %}
                        <tr>

                            <td> {{ bibliotecario.users.nombre }}</td>
                            <td>{{bibliotecario.users.username}}</td>
                            {% if bibliotecario.habilitado %}
                            <td>
                                <a href="{{url('bibliotecarios/editar/'~ bibliotecario.id)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>
                                <a href="{{url('bibliotecarios/show/'~ bibliotecario.id)}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> Ver </a>
                                <a onclick="return abrir_modal('{{url('bibliotecarios/deshabilitar/'~ bibliotecario.id)}}')" class="btn btn-warning"><i class="fa fa-lock" aria-hidden="true"></i>Deshabilitar</a>
                            </td>
                            {% else %}
                            <td>
                                <a onclick="return abrir_modal('{{url('bibliotecarios/deshabilitar/'~ bibliotecario.id)}}')" class="btn btn-success"><i class="fa fa-unlock" aria-hidden="true"></i>Habilitar</a>
                            </td>
                            {% endif %}

                        </tr>
                        {% endfor %}
           </tbody>
                </table>
                <a href='bibliotecarios/crear' class='btn btn-primary'>
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Agregar bibliotecario
                    </a>
 
            </div>
        </div>
    </div>
</div>

<!-- Modal deshabilitar -->
<div id="popup" class="modal fade" role="dialog">
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