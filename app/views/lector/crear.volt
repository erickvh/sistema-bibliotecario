{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Crear Lectores {% endblock %}
{% block iconActual %}
<h1><i class="fa fa-book"></i> Crear Lectores </h1>
<p>Registrar un lector</p>
{% endblock %} 

{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Formulario de registro de lectores</h3>
            <form action="" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label class="control-label">Usuario</label>
                    <input name="usuario" class="form-control" type="text" placeholder="Nombre de usuario" value="" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nom" class="form-control" type="text" placeholder="Nombre" value="" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Apellido</label>
                    <input name="apellido" class="form-control" type="text" placeholder="apellido" value="" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Fecha de nacimiento</label>
                    <input name="fechadenacimiento" class="form-control" type="date" placeholder="fecha de nacimiento" value="">
                </div> 
                 <div class="form-group">
                    <label class="control-label">Lugar de estudio</label>
                    <input name="lugardeestudio" class="form-control" type="text" placeholder="Lugar de estudio" value="">
                </div>
                <div class="form-group">
                    <label for="sexo">Genero</label>
                    <select class="form-control" id="sexo" name='sexo'>
                      <option value='M'>Masculino</option>
                      <option value='F'>Femenino</option>
                    </select>
                  </div>  
                  <div class="form-group">
                    <label for="ocupacion">Ocupacion</label>
                    <select class="form-control" id="ocupacion" name='ocupacion'>
                      <option value=''>Estudiante</option>
                      <option value=''>Trabajador</option>
                      <option value=''>Ambos</option>
                    </select>
                  </div>
                 
                <div class="form-group">
                    <label class="control-label">Direccion</label>
                    <input name="direccion" class="form-control" type="text" placeholder="Direccion" value="">
                </div>
                <div class="form-group">
                    <label class="control-label">Nombre de padre</label>
                    <input name="nomPadre" class="form-control" type="text" placeholder="Nombre de padre" value="">
                </div>
                <div class="form-group">
                    <label class="control-label">Nombre de madre</label>
                    <input name="nomMadre" class="form-control" type="text" placeholder="Nombre de madre" value="">
                </div>
                <div class="form-group">
                    <label class="control-label">Telefono</label>
                    <input name="telefono" class="form-control" type="tel" placeholder="Telefono" >
                </div>
                <input type="submit" class="text-center btn btn-primary" value="Guardar">
            </form>
        </div>
    </div>
</div>
{% endblock %}

{% block extraJS %} 
<script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>


<script type="text/javascript">
      
      $('#autoresLibro').select2(); 


</script>

{% endblock %}