{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Editar Recurso {{material.id}}
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Editar Recurso</h3>
            <form action="" method="post">
                    <div class="form-group">
                        <label class="control-label">Nombre recurso</label>
                        <input type="text" name="nombreMaterial" class="form-control" value="{{material.nombre}}" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Descripcion recurso</label>
                        <textarea name="descMaterial" id="" cols="30" rows="3" class="form-control">{{material.descripcion}}</textarea>
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
                        <input  name="nomImgMaterial" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha de Publicacion</label>
                        <input  name="fechaMaterial" type="date" class="form-control" value="{{material.fechapublicacion}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Es externo</label>
                        {% if material.esexterno %}
                        	<input  name="externoMaterial" type="checkbox" checked>
                        {% else %}
                        	<input  name="externoMaterial" type="checkbox">
                        {% endif %}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Formato</label>
                        <select name="tipoFormato" id="tipoFormato" class="form-control">
                        	<option selected="true" value="{{formatoActual.tipoformato}}">{{formatoActual.tipoformato}} (Actual)</option>
                            {% for f in formatos %}
                            <option value="{{f.tipoformato}}">{{f.tipoformato}}</option>
                            {% endfor %}
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Subcategoria</label>
                        <select name="subMaterial" id="subMaterial" class="form-control">
                        	<option selected="true" value="{{subActual.nombre}}">{{subActual.nombre}}(Actual)</option>
                            {% for s in sub %}
                            <option value="{{s.nombre}}">{{s.nombre}}</option>
                            {% endfor %}
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Unidades Existentes</label>
                        <input type="number" name="cantidadMaterial" class="form-control" value="{{unidades.unidadesexistentes}}">
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
</script>
{% endblock %}