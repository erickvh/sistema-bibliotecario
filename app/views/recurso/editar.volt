{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Editar Recurso {{material.id}}
{% endblock %}
{% block iconActual %}
<h1><i class="fa fa-paperclip"></i> Editar recurso </h1>
<p>Editar un recurso</p>
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Editar Recurso</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Nombre recurso</label>
                    <input type="text" name="nombreMaterial" class="form-control" value="{{material.nombre}}" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Descripcion recurso</label>
                    <textarea name="descMaterial" id="" cols="30" rows="3" class="form-control">{{material.descripcion}}</textarea>
                </div>
                <div class="form-group">
                    <label for="imagenLibro">Imagen</label>
                    <input name="imagenLibro" class="form-control-file" id="imagenLibro" type="file" aria-describedby="fileHelp"><small class="form-text text-muted" id="fileHelp">Seleccione la imagen del libro.</small>
                  </div>
                <div class="form-group">
                    <label class="control-label">Nombre de la imagen</label>
                    <input name="nomImgMaterial" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Fecha de Publicacion</label>
                    <input name="fechaMaterial" type="date" class="form-control" value="{{material.fechapublicacion}}" min="1950-01-01">
                </div>
                <div class="form-group">
                    <label class="control-label">Es externo</label>
                    {% if material.esexterno %}
                    <input name="externoMaterial" type="checkbox" checked>
                    {% else %}
                    <input name="externoMaterial" type="checkbox">
                    {% endif %}
                </div>
                <div class="form-group">
                    <label class="control-label">Formato</label>
                    <select name="tipoFormato" id="tipoFormato" class="form-control">
                        {% for f in formatos %}
                        <option value="{{f.tipoformato}}" {% if recursoActual.idformato==f.id %} selected {% endif %}>{{f.tipoformato}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Subcategoria</label>
                    <select name="subMaterial" id="subMaterial" class="form-control">
                        {% for s in sub %}
                        <option value="{{s.nombre}}" {% if material.idsubcategoria==s.id %} selected {% endif %}>
                           {{s.categorias.nombre}} : {{s.nombre}}
                        </option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Autores</label>
                    <select name="autoresRecurso[]" id="autoresRecurso" class="form-control select2-multiple" multiple="multiple" required>
                        {% for a in autores %}
                        <option value="{{a.id}}" {% for ma in mataut %} {% if ma.idautor==a.id %} selected {% endif %}{% endfor %}>{{a.nombre}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Unidades Existentes</label>
                    <input type="number" name="cantidadMaterial" class="form-control" value="{{unidades.unidadesexistentes}}" min="1" step="1" required>
                </div>
                <button type="Submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
{% endblock %}
{% block extraJS %}
<script type="text/javascript" src="/js/plugins/select2.min.js"></script>
<script type="text/javascript">
$('#tipoFormato').select2();
$('#subMaterial').select2();
$('#autoresRecurso').select2();
</script>
{% endblock %}