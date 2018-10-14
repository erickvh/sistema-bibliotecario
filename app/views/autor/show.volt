{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Mostrar Autor {{autor.id}} {% endblock %} 
{% block iconActual%}
<h1><i class="fa fa-user-circle"></i> Mostrar autor  </h1>
<p>Mostrar un autor</p>
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Datos Autor</h3>

                    <div class="form-group">
                        <label class="control-label">Nombre de autor</label>
                        <input name="nombre" class="form-control" type="text" placeholder="Digite nombre de autor" value="{{ autor.nombre}}" readonly    >
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nacionalidad</label>
                        <input name="nacionalidad" class="form-control" type="text" placeholder="Digite Nacionalidad" value="{{ autor.nacionalidad}}" readonly   >
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha Nacimiento</label>
                        <input type='date' class="form-control" id="fechanacimiento" name="fechanacimiento" type="text" value="{{ autor.fechanacimiento }}"  readonly  placeholder="Seleccionar fecha">
                    </div>
                 <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <input type='text' class='form-control' value='{{autor.sexo=='M'?'Masculino':'Femenino'}}' readonly>
                  </div>
        </div>
    </div>
</div>
{% endblock %}