{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Perfil {% endblock %} 
{% block contenido %}
	<h3>Usuario: {{usuario.username}}</h3>
	<h3>Nombre: {{usuario.nombre}}</h3>  
	<h3>Rol: {{usuario.roles.nombre}}</h3>
	<a href="/perfil/cambiar" class="btn btn-success">Cambiar Contraseña</a>  
{% endblock  %}