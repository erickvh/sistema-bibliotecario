{% extends 'layouts/admin.volt' %} 
{% block titulo %} Editar Bibliotecario {{ bibliotecario.id }} {% endblock %} 
{% block contenido %}
<form action="/bibliotecarios/{{bibliotecario.id}}" method="post" autocomplete='off'>
                 <div class="form-group">
                    <label for="bibliotecas">Bibliotecas actuales</label>
                    <select class="form-control" id="biblioteca" name='biblioteca'>
                      {% for biblioteca in bibliotecas %}

                      <option value='{{biblioteca.id}}' {{ biblioteca.id==bibliotecario.idbiblioteca? 'selected':''}}>{{biblioteca.nombre}}</option>
                    
                      {% endfor %}
                    </select>
                  </div>
                    <div class="form-group ">
                        <label class="control-label">Nombre de bibliotecario</label>
                        <input name="nombre" value='{{bibliotecario.users.nombre}}' class="form-control" type="text" placeholder="Digite nombre completo bibliotecario" required>

                    </div>
                    <div class="form-group">
                        <label class="control-label">Nombre usuario</label>
                        <input name="username"  value='{{bibliotecario.users.username}}'class="form-control" type="text" placeholder="Digite username" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Numero de DUI</label>
                        <input name="dui"  value='{{bibliotecario.dui}}'class="form-control" type="text" placeholder="Digite numero de DUI" required>
                    </div>
  
                    <div class="form-group">
                        <label class="control-label">Fecha Nacimiento</label>
                        <input class="form-control" value='{{bibliotecario.users.fechanacimiento}}' id="fechanacimiento" name="fechanacimiento" type="date" placeholder="Seleccionar fecha">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input name="email"  value='{{bibliotecario.users.email}}'class="form-control" type="email" placeholder="Digite email" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Telefono</label>
                        <input name="telefono"  value='{{bibliotecario.telefono}}'class="form-control" type="tel" placeholder="Telefono" required>
                    </div>
                 <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select class="form-control" id="sexo" name='sexo'>
                      <option value='M' {{ bibliotecario.users.sexo =='M'? 'selected':'' }}>Masculino</option>
                      <option value='F' {{ bibliotecario.users.sexo =='F'? 'selected':'' }}>Femenino</option>
                    </select>
                  </div>
                    <button type="Submit" class="btn btn-primary">Actualizar</button>

            </form>
{% endblock %}
