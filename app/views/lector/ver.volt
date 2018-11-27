{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Mostrar Lector {{prestamista.id}}  {% endblock %}

{% block iconActual %}
<h1><i class="fa fa-paperclip"></i> Mostrar Lector </h1>
<p>Datos del lector</p>
{% endblock %} 

{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Datos del Lector</h3>
             <div class="form-group">
                    <label for="usuario">Nombre de usuario</label>
                    <input readonly name="usuario" value='{{prestamista.users.username}}' class="form-control" type="text" placeholder="Digite nombre de usuario" required>

                     </div>
                    <div class="form-group ">
                        <label class="control-label">Nombre del lector</label>
                        <input readonly name="nombre" value='{{prestamista.users.nombre}}' class="form-control" type="text" placeholder="Digite nombre completo" required>

                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input  readonly name="email"  value='{{prestamista.users.email}}'class="form-control" type="email" placeholder="Digite email" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha Nacimiento</label>
                        <input readonly  class="form-control" value='{{prestamista.users.fechanacimiento}}' id="fechanacimiento" name="fechanacimiento" type="date" placeholder="Seleccionar fecha">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">Lugar de estudio</label>
                        <input readonly name="username"  value='{{prestamista.lugardeestudio}}'class="form-control" type="text" placeholder="Digite username" required>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Genero</label>
                        <input readonly name="sexos"  value='{{prestamista.users.sexo=='M'?'Masculino':'Femenino'}}' class="form-control" type="tel" placeholder="sexo" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ocupacion</label>
                        <input readonly name="direccion"  value='{{ocupacion}}'class="form-control" type="tel" placeholder="Telefono" required>
                    </div> 
                    <div class="form-group">
                        <label class="control-label">Direccion</label>
                        <input readonly name="direccion"  value='{{prestamista.direccion}}'class="form-control" type="tel" placeholder="Telefono" required>
                    </div> 
                    
                <div class="form-group">
                    <label class="control-label">Municipio</label>
                    <input readonly name="municipio"  value='{{prestamista.municipios.nombre}}'class="form-control" type="tel" placeholder="Telefono" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Nombre del Padre</label>
                    <input readonly name="nombredepadre"  value='{{prestamista.nombredepadre}}'class="form-control" type="tel" placeholder="Telefono" required>
                </div>                 
                <div class="form-group">
                    <label class="control-label">Nombre de la Madre</label>
                    <input readonly name="nombredemadre"  value='{{prestamista.nombredemadre}}'class="form-control" type="tel" placeholder="Telefono" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Telefono</label>
                    <input readonly name="telefono"  value='{{prestamista.telefono}}'class="form-control" type="tel" placeholder="Telefono" required>
                </div> 
                <div class="form-group">
                    <label class="control-label">Estado</label>
                    <input readonly name="telefono"  value='{{prestamista.activo=='true'?'Activo':'Inactivo'}}'class="form-control" type="tel" placeholder="Telefono" required>
                </div>    
        </div>
    </div>
</div>

{% endblock %}