{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Crear Sub Categoria {% endblock %}
{% block iconActual%}
<h1><i class="fa fa-list-alt"></i> Crear subcategoria </h1>
<p>Registrar una subcategoria </p>
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <form action="" method="post">
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nombreSubCat" class="form-control" type="text" placeholder="Ingrese nombre de la categoria"  >
                </div>
                <div class="form-group">
                    <label class="control-label">Descripcion</label>
                    <textarea name="descSubCat" class="form-control" rows="4" placeholder="Ingrese la descripción de la categoria"></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Codigo</label>
                    <input name="codSubCat" class="form-control" type="text" placeholder="Codigo de la categoria"    >
                </div>
                <div class="form-group">
                        <label class="control-label">Categoria</label>
                        <select name="categoria" id="categoria" class="form-control" >
                            {% for c in categoria %}
                            <option value="{{c.nombre}}">{{c.nombre}}</option>
                            {% endfor %}
                        </select>
                    </div>
                <div class="form-group">                    
                    <button type="Submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}

{% block extraJS %}
<script type="text/javascript" src="/js/plugins/select2.min.js"></script>
<script type="text/javascript" src="/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$('#tabFormato').DataTable({
    'language': {
        'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
    }
});
$('#categoria').select2();
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