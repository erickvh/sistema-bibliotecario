{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Autores
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
                        <th>Nacionalidad</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        {% for autor in autores %}
                        <tr>
                            <td> {{autor.nombre}}</td>
                            <td>{{autor.nacionalidad}}</td>
                            <td>
                                <a href="{{url('autor/editar/'~ autor.id)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>
                                <a href="{{url('autor/show/'~ autor.id)}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> Ver </a>
                                <a onclick="return abrir_modal()" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
                            </td>
                        </tr>
                        {%endfor%}
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearAutorModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Agregar Autor
                </button>
            </div>
        </div>
    </div>
</div>
<!-- modal  -->
<div class="modal fade" id="crearAutorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Registrar Autor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/autor" method="post" autocomplete='off'>
                    <div class="form-group">
                        <label class="control-label">Nombre de autor</label>
                        <input name="nombre" class="form-control" type="text" placeholder="Digite nombre de autor" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nacionalidad</label>
                        <input name="nacionalidad" class="form-control" type="text" placeholder="Digite Nacionalidad" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha Nacimiento</label>
                        <input class="form-control" id="fechanacimiento" name="fechanacimiento" type="text" placeholder="Seleccionar fecha">
                    </div>
                 <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select class="form-control" id="sexo" name='sexo'>
                      <option value='M'>Masculino</option>
                      <option value='F'>Femenino</option>
                    </select>
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
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Eliminar Autor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-lg-12">
                <p> ¿Desea eliminar autor <strong>{{autor.nombre}}</strong>? </p>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-lg-12 text-right">
                <form role="form" action="{{url('autor/borrar/'~ autor.id)}}" method="post">
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
<script type="text/javascript" src="/js/plugins/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
$('#tabFormato').DataTable({
    'language': {
        'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
    }
});
</script>
<script type="text/javascript">
var modal;

function abrir_modal() {

    $('#popup').modal('show');
    return false;
}

function cerrar_modal() {
    $('#popup').modal('hide');
    return false;
}
      $('#fechanacimiento').datepicker({
      	format: "dd/mm/yyyy",
      	autoclose: true,
      	todayHighlight: true
      });
</script>
{% endblock %}