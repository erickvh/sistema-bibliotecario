{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Editar Formato {{formato.id}} {% endblock %} 
{% block iconActual%}
<h1><i class="fa fa-cubes"></i> Editar formato </h1>
<p>Editar un formato </p>
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Editar Formato</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label class="control-label">Tipo de Formato</label>
                    <input name="tipoFormato" class="form-control" type="text" placeholder="Formato" value="{{formato.tipoformato}}" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Descripcion</label>
                    <textarea name="descFormato" class="form-control" rows="4" placeholder="Ingrese la descripción del formato" required>{{formato.descripcion}}</textarea>
                </div>
                <input type="submit" class="text-center btn btn-primary" value="Guardar">
            </form>
        </div>
    </div>
</div>
{% endblock %}