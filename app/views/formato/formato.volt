{% extends 'layouts/bibliotecario.volt' %} {% block titulo %} Formato {% endblock %} {% block extraCSS %}
<style>
    table th {
        text-align: center;
    }
    
    table tr {
        text-align: center;
    }
</style>
</style>
{% endblock %} {% block contenido %}
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
                            <td class="justify-content-center"><a href="/formato/editar/{{f.id}}" class="btn btn-success">Editar</a>
                                <a href="/formato/eliminar/{{f.id}}" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                        {%endfor%}
                    </tbody>
                </table>
                <a href="/formato/crear" class="btn btn-primary">Agregar Nuevo Formato</a>
            </div>
        </div>
    </div>
</div>
{% endblock %} {% block extraJS %}
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