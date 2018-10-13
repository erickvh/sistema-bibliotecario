{% extends 'layouts/admin.volt' %} 
{% block titulo %} Mostrar Bibliotecario {{bibliotecario.id}} {% endblock %} 

{% block iconActual %}
<h1><i class="fa fa-users"></i> Bibliotecarios </h1>
<p>información bibliotecario</p>
{% endblock %} 
{% block contenido %}



<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Datos Bibliotecario</h3>
             <div class="form-group">
                    <label for="bibliotecas">Biblioteca</label>
                    <input readonly name="nombre" value='{{bibliotecario.bibliotecas.nombre}}' class="form-control" type="text" placeholder="Digite nombre completo bibliotecario" required>

                     </div>
                    <div class="form-group ">
                        <label class="control-label">Nombre de bibliotecario</label>
                        <input readonly name="nombre" value='{{bibliotecario.users.nombre}}' class="form-control" type="text" placeholder="Digite nombre completo bibliotecario" required>

                    </div>
                    <div class="form-group">
                        <label class="control-label">Nombre usuario</label>
                        <input readonly name="username"  value='{{bibliotecario.users.username}}'class="form-control" type="text" placeholder="Digite username" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Numero de DUI</label>
                        <input readonly name="dui"  value='{{bibliotecario.dui}}'class="form-control" type="text" placeholder="Digite numero de DUI" required>
                    </div>
  
                    <div class="form-group">
                        <label class="control-label">Fecha Nacimiento</label>
                        <input readonly  class="form-control" value='{{bibliotecario.users.fechanacimiento}}' id="fechanacimiento" name="fechanacimiento" type="date" placeholder="Seleccionar fecha">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input  readonly name="email"  value='{{bibliotecario.users.email}}'class="form-control" type="email" placeholder="Digite email" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Telefono</label>
                        <input readonly name="telefono"  value='{{bibliotecario.telefono}}'class="form-control" type="tel" placeholder="Telefono" required>
                    </div>
                 <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <input readonly name="sexos"  value='{{bibliotecario.users.sexo=='M'?'Masculino':'Femenino'}}' class="form-control" type="tel" placeholder="Telefono" required>
                    
                  </div>
                
    
        </div>
    </div>
</div>
{% endblock %}