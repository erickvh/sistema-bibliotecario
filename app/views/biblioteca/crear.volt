{% extends "layouts/admin.volt" %}

{%  block titulo %} Biblioteca {% endblock %}



{% block contenido %}
  <div class="row">
    <div class="col">
      <div class="tile">
        <center>
        <h3 class="tile-title">Formulario de registro de Bibliotecas</h3>
        </center>
        <div class="tile-body">
             <form action="" method="post">
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nombreBiblioteca" class="form-control" type="text" placeholder="Ingrese el Nombre de la Biblioteca" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Ubicación</label>
                    <input name="ubicacionBiblioteca" class="form-control" type="text" placeholder="Ubicación" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Teléfono</label>
                    <input name="telefonoBiblioteca" class="form-control" type="text" placeholder="Teléfono" required>
                </div> 
                 <div class="form-group">
                    <label class="control-label">Clasificación</label>
                    <input name="clasBiblioteca" class="form-control" type="text" placeholder="Clasificación">
                </div>  
                 <div class="form-group">
                    <label class="control-label">URL de logo</label>
                    <input name="logourlBiblioteca" class="form-control" type="text" placeholder="URL">
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
            </form>
        </div>
       
      </div>
    </div>
  </div>
{% endblock %}