{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Categoria
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
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        {% for cat in categoria %}
                        <tr>
                            <td> {{cat.nombre}}</td>
                            <td>{{cat.descripcion}}</td>
                            <td>
                                <a href="{{url('categoria/editar/'~ cat.id)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>
                                <a onclick="return abrir_modal('{{url('categoria/eliminar/'~ cat.id)}}')" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
                            </td>
                        </tr>
                        {%endfor%}
                    </tbody>
                </table>
                <a type="button" class="btn btn-primary" href="/categoria/crear">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Agregar Categoria
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
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