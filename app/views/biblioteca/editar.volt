{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Editar Biblioteca {{biblioteca.id}} {% endblock %}
{% block iconActual %}
<h1><i class="fa fa-building"></i>Biblioteca</h1>
<p></p>
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Editar</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nombreBiblioteca" class="form-control" type="text" placeholder="Nombre" value="{{biblioteca.nombre}}" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Ubicación</label>
                    <input name="ubicacionBiblioteca" class="form-control" type="text" placeholder="Ubicación" value="{{biblioteca.ubicacion}}" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Teléfono</label>
                    <input name="telefonoBiblioteca" class="form-control" type="text" placeholder="Teléfono" value="{{biblioteca.telefono}}" required>
                </div> 
                 <div class="form-group">
                    <label class="control-label">Clasificación</label>
                    <input name="clasBiblioteca" class="form-control" type="text" placeholder="Clasificación" value="{{biblioteca.clasificacion}}">
                </div>  
                 <div class="form-group">
                    <label class="control-label">URL de logo</label>
                    <input name="logourlBiblioteca" class="form-control" type="text" placeholder="URL" value="{{biblioteca.logourl}}">
                </div> 
                 <div class="form-group">
                    <label class="control-label">Nombre de logo</label>
                    <input name="nomlogoBiblioteca" class="form-control" type="text" placeholder="Nombre del logo" value="{{biblioteca.nombrelogo}}">
                </div> 
                 <div class="form-group">
                    <label class="control-label">Email</label>
                    <input name="emailBiblioteca" class="form-control" type="email" placeholder="Email" value="{{biblioteca.email}}">
                </div>              
                <input type="submit" class="text-center btn btn-primary" value="Guardar">
            </form>
        </div>
    </div>
</div>
{% endblock %}