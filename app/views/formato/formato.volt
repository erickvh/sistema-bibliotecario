{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Formato
{% endblock %}
{% block iconActual%}
<h1><i class="fa fa-cubes"></i> Formatos </h1>
<p>Sección de  gestion de formatos </p>
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
                        {% for f in formato%}
                        <tr>
                            <td> {{f.tipoformato}}</td>
                            <td>{{f.descripcion}}</td>
                            <td>
                                <a href="{{url('formato/editar/'~ f.id)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>
                                <a onclick="return abrir_modal('{{url('formato/eliminar/'~ f.id)}}')" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
                            </td>
                        </tr>
                        {%endfor%}
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearFormatoModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Agregar Formato
                </button>
            </div>
        </div>
    </div>
</div>
<!-- modal  -->
<div class="modal fade" id="crearFormatoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Crear Formato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="control-label">Tipo de Formato</label>
                        <input name="tipoFormato" class="form-control" type="text" placeholder="Formato" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Descripcion</label>
                        <textarea name="descFormato" class="form-control" rows="4" placeholder="Ingrese la descripción del formato" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="Submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
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