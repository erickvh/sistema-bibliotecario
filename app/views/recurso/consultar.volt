{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Recurso
{% endblock %}
{% block iconActual %}
<h1><i class="fa fa-paperclip"></i> Recursos </h1>
<p>Sección de gestion de recursos</p>
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
<div style="padding-left: 82%; padding-bottom: 10px;">
    <a type="button" href="/recurso/crear" class="btn btn-primary">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Agregar Material
                </a>
</div>
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
                        {% for mat in recursos %}
                        {% if mat.Materialesbibliograficos.idbiblioteca == idbiblioteca %}
                        <tr>
                            <td> {{mat.Materialesbibliograficos.nombre}}</td>
                            <td>{{mat.Materialesbibliograficos.descripcion}}</td>
                            <td>
                                <a href="{{url('recurso/editar/'~ mat.Materialesbibliograficos.id)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>
                                <a onclick="return abrir_modal('{{url('recurso/eliminar/'~ mat.Materialesbibliograficos.id)}}')" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
                            </td>
                        </tr>
                        {%endif%}
                        {%endfor%}
                    </tbody>
                </table>
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