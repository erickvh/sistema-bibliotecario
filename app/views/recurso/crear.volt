{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Crear Recurso
{% endblock %}
{% block contenido %}
<form action="" method="post">
    <div class="form-group">
        <label class="control-label">Nombre recurso</label>
        <input type="text" name="nombreMaterial" class="form-control" required>
    </div>
    <div class="form-group">
        <label class="control-label">Descripcion recurso</label>
        <textarea name="descMaterial" id="" cols="30" rows="3" class="form-control"></textarea>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Imagen</span>
        </div>
        <div class="custom-file">
            <input name="imagenMaterial" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">Seleccionar Imagen</label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">Nombre de la imagen</label>
        <input name="nomImgMaterial" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label class="control-label">Fecha de Publicacion</label>
        <input name="fechaMaterial" type="date" class="form-control">
    </div>
    <div class="form-group">
        <label class="control-label">Es externo</label>
        <input name="externoMaterial" type="checkbox">
    </div>
    <div class="form-group">
        <label class="control-label">Formato</label>
        <select name="tipoFormato" id="tipoFormato" class="form-control">
            {% for f in formatos %}
            <option value="{{f.tipoformato}}">{{f.tipoformato}}</option>
            {% endfor %}
        </select>
    </div>
    <div class="form-group">
        <label class="control-label">Autores</label>
        <select name="autoresRecurso[]" id="autoresLibro" class="form-control select2-multiple" multiple="multiple" required>
            {% for a in autores %}
            <option value="{{a.id}}">{{a.nombre}}</option>
            {% endfor %}
        </select>
    </div>
    <div class="form-group">
        <label class="control-label">Subcategoria</label>
        <select name="subMaterial" id="subMaterial" class="form-control">
            {% for s in sub %}
            <option value="{{s.nombre}}">{{s.nombre}}</option>
            {% endfor %}
        </select>
    </div>
    <div class="form-group">
        <label class="control-label">Unidades Existentes</label>
        <input type="number" name="cantidadMaterial" class="form-control">
    </div>
    <div class="form-group">        
        <button type="Submit" class="btn btn-primary">Crear</button>
    </div>
</form>

{% endblock %}
{% block extraJS %}
<script type="text/javascript" src="/js/plugins/select2.min.js"></script>
<script type="text/javascript">

$('#tipoFormato').select2();
$('#subMaterial').select2();
$('#autoresLibro').select2();
</script>
{% endblock %}