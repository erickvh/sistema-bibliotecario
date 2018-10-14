{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Perfil {% endblock %}
{% block iconActual %}
<h1><i class="fa fa-user-secret" aria-hidden="true"></i>
 Perfil </h1>
<p>Sección para cambiar la contraseña del usuario </p>
{% endblock %}
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
        	<form action="">
        		<div class="form-group">
                    <label class="control-label">Usuario:</label>
                    <input class="form-control" type="text" readonly value="{{usuario.username}}">
                </div>
                <div class="form-group">
                    <label class="control-label">Nombre:</label>
                    <input class="form-control" type="text" readonly value="{{usuario.nombre}}">
                </div>
                <div class="form-group">
                    <label class="control-label">Fecha de Nacimiento:</label>
                    <input class="form-control" type="date" value="{{usuario.fechanacimiento}}" readonly>
                </div>
                <div class="form-group">
                    <label class="control-label">Sexo:</label>
                    {% if usuario.sexo == 'M' %}
                    <input class="form-control" type="text" value="Masculino" readonly>
                    {% else %}
                    <input class="form-control" type="text" value="Femenino" readonly>
                    {% endif %}
                </div>
                <div class="form-group">
                    <label class="control-label">Rol:</label>
                    <input class="form-control" type="text" value="{{usuario.roles.nombre}}" readonly>
                </div>
        	</form>            
            <a href="/perfil/cambiar" class="btn btn-success">Cambiar Contraseña</a>
        </div>
    </div>
</div>
{% endblock %}