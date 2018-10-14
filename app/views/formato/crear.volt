{% extends 'layouts/bibliotecario.volt' %} {% block titulo %} Formato {% endblock %} {% block contenido %} {% if error %}
<div class="alert alert-danger">Error</div>
{% endif %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Crear Nuevo Formato</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label class="control-label">Tipo de Formato</label>
                    <input name="tipoFormato" class="form-control" type="text" placeholder="Formato"   >
                </div>
                <div class="form-group">
                    <label class="control-label">Descripcion</label>
                    <textarea name="descFormato" class="form-control" rows="4" placeholder="Ingrese la descripción del formato"></textarea>
                </div>
                <input type="submit" class="text-center btn btn-primary" value="Crear">
            </form>
        </div>
    </div>
</div>
{% endblock %}