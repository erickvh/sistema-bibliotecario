{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Editar Autor {{autor.id}} {% endblock %} 
{% block iconActual%}
<h1><i class="fa fa-user-circle"></i> Editar autor  </h1>
<p>Editar un autor</p>
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Editar Autor</h3>
            <form action="/autor/{{ autor.id }}" method="post" autocomplete="off">
                    <div class="form-group">
                        <label class="control-label">Nombre de autor</label>
                        <input name="nombre" class="form-control" type="text" placeholder="Digite nombre de autor" value="{{ autor.nombre}}" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nacionalidad</label>
                        <input name="nacionalidad" class="form-control" type="text" placeholder="Digite Nacionalidad" value="{{ autor.nacionalidad }}"required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha de Publicacion</label>
                        <input name="fechaMaterial" type="date" value="{{autor.fechanacimiento}}"class="form-control">
                    </div>
                 <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select class="form-control" id="sexo" name='sexo'>
                      <option value='M' {{ autor.sexo =='M'? 'selected':'' }} >Masculino</option>
                      <option value='F' {{ autor.sexo =='F'? 'selected':'' }} >Femenino</option>
                    </select>
                  </div>
                <input type="submit" class="text-center btn btn-primary" value="Guardar">
            </form>
        </div>
    </div>
</div>
{% endblock %}
