{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Crear Categoria {% endblock %}
{% block iconActual%}
<h1><i class="fa fa-list-ul"></i> Crear categoria </h1>
<p>Registrar una categoria </p>
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <form action="" method="post">
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nombreCat" class="form-control" type="text" placeholder="Ingrese nombre de la categoria"  >
                </div>
                <div class="form-group">
                    <label class="control-label">Descripcion</label>
                    <textarea name="descCat" class="form-control" rows="4" placeholder="Ingrese la descripción de la categoria"></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Codigo</label>
                    <input name="codCat" class="form-control" type="text" placeholder="Codigo de la categoria"  >
                </div>
                <div class="form-group">                    
                    <button type="Submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}