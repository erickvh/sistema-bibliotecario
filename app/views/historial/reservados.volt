{% extends 'layouts/prestamista.volt' %}
{% block titulo %} Reservados
{% endblock %}
{% block iconActual%}
<h1><i class="fa fa-user-circle"></i> Autores </h1>
<p>Sección de  gestion de libros reservados </p>
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
                        <th>Fecha para reserva</th>
                        <th>Fue solicitado</th>
                        <th> Cancelar reserva </th>
                    </thead>
                    <tbody>
                        {% for reserva in reservas %}
                        <tr>
                            <td>{{reserva.materialesbibliograficos.nombre}}</td>
                            <td>{{reserva.fechareserva}}</td>
                            <td>{{reserva.fechasolicitud}}</td>
                            <td>
                                <button  class="btn btn-warning" data-toggle="modal" data-target="#cancelar"><i class="fa fa-trash" aria-hidden="true"></i>Cancelar Reserva</button>
                            </td>
                        </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div id="cancelar" class="modal fade" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Cancelar Reserva</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-lg-12">
                <p> ¿Desea cancelar el presta de material <strong>{{reserva.materialesbibliograficos.nombre}}</strong>? </p>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-lg-12 text-right">
                <form role="form" action="{{url('reserva/eliminar/'~ reserva.id)}}" method="post">
                    <input type="submit" class="btn btn-danger" id="despedir" value="Si">
                    <button type="button" class="btn btn-secondary" onclick="return cerrar_modal()"> No </button>
                </form>
            </div>
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