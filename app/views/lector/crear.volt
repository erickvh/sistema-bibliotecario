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
                    <input name="usuario" class="form-control" type="text" placeholder="Digite el nombre de usuario" value="" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nombre" class="form-control" type="text" placeholder="Digite el nombre completo del lector" value="" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input name="email" class="form-control" type="text" placeholder="Digite el email del lector" value="" required>
                </div>
                <!--
                <div class="form-group">
                    <label class="control-label">Apellido</label>
                    <input name="apellido" class="form-control" type="text" placeholder="apellido" value="" required>
                </div>-->
                <div class="form-group">
                    <label class="control-label">Fecha de nacimiento</label>
                    <input name="fechanacimiento" class="form-control" type="date" placeholder="Selecciones la fecha de nacimiento" value="">
                </div> 
                 <div class="form-group">
                    <label class="control-label">Lugar de estudio</label>
                    <input name="lugardeestudio" class="form-control" type="text" placeholder="Digite el Lugar de estudio" value="">
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
                      <option value='estudiante'>Estudiante</option>
                      <option value='trabajador'>Trabajador</option>
                      <option value='ambos'>Ambos</option>
                    </select>
                  </div>
                 
                <div class="form-group">
                    <label class="control-label">Direccion</label>
                    <input name="direccion" class="form-control" type="text" placeholder="Digite la Direccion del lector" value="">
                </div>
                <div class="form-group">
                    <label class="control-label">Municipio</label>
                    <select name="municipio" id="municipio" class="form-control">
                        {% for m in municipios %}
                        <option value="{{m.id}}">{{m.nombre}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Nombre del padre</label>
                    <input name="nombrePadre" class="form-control" type="text" placeholder="Digite el Nombre del padre" value="">
                </div>
                <div class="form-group">
                    <label class="control-label">Nombre de la madre</label>
                    <input name="nombreMadre" class="form-control" type="text" placeholder="Digite el Nombre de la madre" value="">
                </div>
                <div class="form-group">
                    <label class="control-label">Telefono</label>
                    <input name="telefono" class="form-control" type="tel" placeholder="Digite el Telefono del lector" >
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
{% endblock %}

{% block extraJS %}
<script type="text/javascript">
var modal;

function abrir_modal(url) {
    $('#popup').load(url, function() {
        $(this).modal('show');
    });
    return false;
}

function cerrar_modal() {
    $('#popup').modal('hide');
    return false;
}
</script>
{% endblock %}