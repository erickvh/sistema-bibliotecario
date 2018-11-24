{% extends "layouts/admin.volt" %}

{%  block titulo %} Biblioteca {% endblock %}

{% block iconActual %}
<h1><i class="fa fa-cog"></i> Biblioteca </h1>
<p>Registrar bibliotecas</p>
{% endblock %} 

{% block contenido %}
  <div class="row">
    <div class="col">
      <div class="tile">
        <center>
        <h3 class="tile-title">Formulario de registro de Bibliotecas</h3>
        </center>
        <div class="tile-body">
             <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nombreBiblioteca" class="form-control" type="text" placeholder="Ingrese el Nombre de la Biblioteca"  >
                </div>
                <div class="form-group">
                    <label class="control-label">Ubicación</label>
                    <input name="ubicacionBiblioteca" class="form-control" type="text" placeholder="Ubicación"  >
                </div>
                <div class="form-group">
                    <label class="control-label">Teléfono</label>
                    <input name="telefonoBiblioteca" class="form-control" type="text" placeholder="Teléfono 7777-7777"  >
                </div> 
                 <div class="form-group">
                    <label class="control-label">Clasificación</label>
                    <input name="clasBiblioteca" class="form-control" type="text" placeholder="Clasificación">
                </div>  
                <div class="form-group">
                    <label for="imagenBiblioteca">Imagen</label>
                    <input name="imagenbiblioteca" class="form-control-file" id="imagenLibro" type="file" aria-describedby="fileHelp"><small class="form-text text-muted" id="fileHelp">Seleccione un logo para la biblioteca.</small>
                  </div>
                 <div class="form-group">
                    <label class="control-label">Nombre de logo</label>
                    <input name="nomlogoBiblioteca" class="form-control" type="text" placeholder="Nombre del logo">
                </div> 
                 <div class="form-group">
                    <label class="control-label">Email</label>
                    <input name="emailBiblioteca" class="form-control" type="email" placeholder="Email">
                </div>              
                <input type="submit" class="text-center btn btn-primary" value="Guardar">
                <input type="reset" class="text-center btn btn-secondary" value="Borrar datos del formulario">
            </form>
        </div>
       
      </div>
    </div>
  </div>
{% endblock %}