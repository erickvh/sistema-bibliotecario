{% extends 'layouts/admin.volt' %}
{% block titulo %} bibliotecarios
{% endblock %}
{% block iconActual %}
<h1><i class="fa fa-users"></i> Bibliotecarios </h1>
<p>Registrar bibliotecario</p>
{% endblock %} 
{% block contenido %}

                <form action="/bibliotecarios" method="post" autocomplete='off'>
                 <div class="form-group">
                    <label for="bibliotecas">Bibliotecas actuales *</label>
                    <select class="form-control" id="biblioteca" name='biblioteca'>
                      {% for biblioteca in bibliotecas %}
                      <option value='{{biblioteca.id}}'>{{biblioteca.nombre}}</option>

                      {% endfor %}
                    </select>
                  </div>
                    <div class="form-group ">
                        <label class="control-label">Nombre de bibliotecario *</label>
                        <input name="nombre" class="form-control" type="text" placeholder="Digite nombre completo bibliotecario" >
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nombre usuario *</label>
                        <input name="username" class="form-control" type="text" placeholder="Digite username sin espacios" >
                    </div>
                    <div class="form-group">
                        <label class="control-label">Numero de DUI *</label>
                        <input name="dui" class="form-control" type="text" placeholder="Digite numero de DUI: 00000000-0">
                    </div>
  
                    <div class="form-group">
                        <label class="control-label">Fecha Nacimiento *</label>
                        <input class="form-control" id="fechanacimiento" name="fechanacimiento" type="date" placeholder="Seleccionar fecha">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input name="email" class="form-control" type="email" placeholder="Digite email">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Telefono</label>
                        <input name="telefono" class="form-control" type="tel" placeholder="Telefono 7777-7777" >
                    </div>
                 <div class="form-group">
                    <label for="sexo">Sexo *</label>
                    <select class="form-control" id="sexo" name='sexo'>
                      <option value='M'>Masculino</option>
                      <option value='F'>Femenino</option>
                    </select>
                  </div>
                                    <button type="Submit" class="btn btn-primary">Crear</button>
                                    <input type="reset" class="text-center btn btn-secondary" value="Borrar datos del formulario">

            </form>

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