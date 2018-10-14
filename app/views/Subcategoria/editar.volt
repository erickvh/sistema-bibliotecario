{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Editar Categoria {{subcategoria.id}} {% endblock %}
{% block iconActual%}
<h1><i class="fa fa-list-alt"></i> Editar subcategoria </h1>
<p>Editar una subcategoria </p>
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <form action="" method="post">
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nombreCat" class="form-control" type="text" placeholder="Ingrese nombre de la categoria" required value="{{subcategoria.nombre}}">
                </div>
                <div class="form-group">
                    <label class="control-label">Descripcion</label>
                    <textarea name="descCat" class="form-control" rows="4" placeholder="Ingrese la descripción de la categoria">{{subcategoria.descripcion}}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Codigo</label>
                    <input name="codCat" class="form-control" type="text" placeholder="Codigo de la categoria" required value="{{subcategoria.codigo}}">
                </div>
                <div class="form-group">
                    <label class="control-label">Categoria</label>
                    <select name="categoria" id="categoria" class="form-control" required>
                        {% for c in categoria %}
                        <option value="{{c.nombre}}" 
                        {% if subcategoria.idcategoria == c.id %} selected {% endif %}>
                        {{c.nombre}}</option>
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
<script type="text/javascript">
$('#categoria').select2();
</script>
{% endblock %}