{% extends 'layouts/admin.volt' %} 
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
				<h2 class="text-center">Cambiar Contraseña</h2>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<form action="" method="post">
                <div class="form-group">
                    <label class="control-label">Contraseña Anterior</label>
                    <input name="conAnterior" class="form-control" type="password" placeholder="Contraseña Anterior" required>
                </div>                
                <div class="form-group">
                    <label class="control-label">Contraseña Nueva</label>
                    <input name="conNueva" class="form-control" type="password" placeholder="Contraseña Nueva" required>
                </div>         
                <input type="submit" class="text-center btn btn-primary" value="Guardar">
            </form>
			</div>
		</div>
	</div>
{% endblock  %}