{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Reservas
{% endblock %}
{% block iconActual%}
<h1><i class="fa fa-book"></i> Gestión de Préstamos </h1>
<p>Sección para gestionar las reservaciones realizadas </p>
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
                <table id="tabReservas" class="table table-bordered">
                    <thead class="bg-primary">
                        <th>Prestamista</th>
                        <th>Usuario</th>
                        <th>Material Bibliográfico</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        {% for reserva in reservas %}
                        <tr>
                            <td> {{reserva.Prestamistas.Users.nombre}}</td>
                            <td> {{reserva.Prestamistas.Users.username}}</td>
                            <td> {{reserva.MaterialesBibliograficos.nombre}}</td>
                            <td> {{reserva.fechasolicitud}}</td>
                            <td>                          
                                <a onclick="return abrir_modal('{{url('reserva/prestar/'~ reserva.id)}}')" class="btn btn-success">Prestar</a>
                                <a onclick="return abrir_modal('{{url('reserva/cancelar/'~ reserva.id)}}')" class="btn btn-danger">Cancelar</a>
                            </td>
                        </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal fade" role="dialog">
    </div>

{% endblock %}
{% block extraJS %}
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$('#tabReservas').DataTable({
    'language': {
        'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
    }
});
</script>
<script type="text/javascript">
    var modal;
    
    function abrir_modal(url) {
        $('#modal').load(url, function() {
            $(this).modal('show');
        });
        return false;
    }
    
    function cerrar_modal() {
        $('#modal').modal('hide');
        return false;
    }
    </script>
{% endblock %}