{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Editar Lector {{prestamista.id}} {% endblock %} 
{% block iconActual %}
<h1><i class="fa fa-users"></i> Lector </h1>
<p>editar Lector</p>
{% endblock %} 
{% block contenido %}

<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Datos del Lector</h3>
            <form method="post">
                    <div class="form-group">
                        <label class="control-label">Nombre de usuario</label>
                        <input name="usuario"  value='{{prestamista.users.username}}'class="form-control" type="text" placeholder="" required>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Nombre del lector</label>
                        <input name="nombre" value='{{prestamista.users.nombre}}' class="form-control" type="text" placeholder="Digite nombre completo" required>

                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input name="email"  value='{{prestamista.users.email}}' class="form-control" type="text" placeholder="Digite su email" required>
                    </div>
  
                    <div class="form-group">
                        <label class="control-label">Fecha Nacimiento</label>
                        <input class="form-control" value='{{prestamista.users.fechanacimiento}}' id="fechanacimiento" name="fechanacimiento" type="date" placeholder="Seleccionar fecha" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Lugar de estudio</label>
                        <input name="lugardeestudio"  value='{{prestamista.lugardeestudio}}'class="form-control" type="text" placeholder="Digite su lugar de estudio" required >
                    </div>
                  <div class="form-group">
                    <label for="sexo">Genero</label>
                    <select class="form-control" id="sexo" name='sexo'>
                      <option value='M' {{ prestamista.users.sexo =='M'? 'selected':'' }}>Masculino</option>
                      <option value='F' {{ prestamista.users.sexo =='F'? 'selected':'' }}>Femenino</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="ocupacion">Ocupación</label>
                    <select class="form-control" id="ocupacion" name='ocupacion'>
                      <option value='trabajador' {{ prestamista.trabaja =='true'? 'selected':'' }}>trabajador</option>
                      <option value='estudiante' {{ prestamista.estudia =='true'? 'selected':'' }}>estudiante</option>
                      <option value="ambos" {% if prestamista.trabaja == prestamista.estudia %} 
                      selected {% endif %}>trabaja y estudia</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Direccion</label>
                    <input name="direccion"  value='{{prestamista.direccion}}'class="form-control" type="text" placeholder="Digite su direccion" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Municipio</label>
                    <select name="municipio" id="municipio" class="form-control">
                        {% for m in municipios %}
                        <option value="{{m.id}}" {% if prestamista.idmunicipio == m.id %} 
                        selected {% endif %}>{{m.nombre}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Nombre del padre </label>
                    <input name="nombrePadre"  value='{{prestamista.nombredepadre}}'class="form-control" type="text" placeholder="nombre padre"  required>
                </div>
                    <div class="form-group">
                        <label class="control-label">Nombre de la madre </label>
                        <input name="nombreMadre"  value='{{prestamista.nombredemadre}}'class="form-control" type="text" placeholder="nombre madre" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Telefono </label>
                        <input name="telefono"  value='{{prestamista.telefono}}'class="form-control" type="text" placeholder="Telefono"  required >
                    </div>
                
                    <button type="Submit" class="btn btn-primary">Actualizar</button>
                   </form> 
                </div>
           </div>
         </div>
            
{% endblock %}
