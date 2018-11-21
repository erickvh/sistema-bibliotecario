{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Estadisticas
{% endblock %}
{% block iconActual %}
<h1> Ver Recurso </h1>
<p>Detalles del Recurso</p>
{% endblock %}
{% block extraCSS %}
<style>
    #mostrar_tipo #subcategoria{
        display: none;
    }
</style>
{% endblock %}
{% block contenido %}
<div class="row">
    <div class="col-4">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-categoria" role="tab" aria-controls="home">Estadísticas por categoría</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-subcategoria" role="tab" aria-controls="profile">Estadísticas por subcategorías</a>
        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-zona" role="tab" aria-controls="messages">Estadísticas por zona geográfica</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-librosleidos" role="tab" aria-controls="settings">Estadísticas por libros más leídos</a>
      </div>
    </div>
    <div class="col-8">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-categoria" role="tabpanel" aria-labelledby="list-home-list">
          <div class="container">
            <div class="row">
              <div id="mostrar_tipo">
                <div id="categoria">
                  <h4 class="text-center">Estadistica por Categoría</h4>
                  <form action="/estadistica/categoria" method="GET">
                    <div class="form-group">
                      <label for="fechaInicio">Fecha de inicio:</label>
                      <input id="fechaInicio" class="form-control" type="date" name="fecha_inicio">
                    </div>
                    <div class="form-group">
                      <label for="fechaFin">Fecha de fin:</label>
                      <input id="fechaFin" class="form-control" type="date" name="fecha_fin">
                    </div>
                    <button type="submit" class="btn btn-success">Generar Grafica</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="list-subcategoria" role="tabpanel" aria-labelledby="list-profile-list">
          <div class="container">
            <div class="row">
              <div id="mostrar_tipo">
                <div id="subcategoria">
                  <h4 class="text-center">Estadistica por Subcategoría</h4>
                  <form action="/estadistica/subcategoria" method="GET">
                    <div class="form-group">
                      <label for="categoria">Categoria</label>
                      <select id="categoria" class="form-control" name="id_categoria">
                        {% for c in categorias %}
                        <option value="{{c.id}}">{{c.nombre}}</option>
                        {% endfor %}
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="fechaInicio">Fecha de inicio:</label>
                      <input id="fechaInicio" class="form-control" type="date" name="fecha_inicio">
                    </div>
                    <div class="form-group">
                      <label for="fechaFin">Fecha de fin:</label>
                      <input id="fechaFin" class="form-control" type="date" name="fecha_fin">
                    </div>
                    <button type="submit" class="btn btn-success">Generar Grafica</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="list-zona" role="tabpanel" aria-labelledby="list-messages-list">
          <div class="container">
            <div class="row">
              <div id="mostrar_tipo">
                <div id="zona">
                  <h4 class="text-center">Estadistica por zona geográfica</h4>
                  <form action="/estadistica/categoria" method="GET">
                    <div class="form-group">
                      <label for="fechaInicio">Fecha de inicio:</label>
                      <input id="fechaInicio" class="form-control" type="date" name="fecha_inicio">
                    </div>
                    <div class="form-group">
                      <label for="fechaFin">Fecha de fin:</label>
                      <input id="fechaFin" class="form-control" type="date" name="fecha_fin">
                    </div>
                    <button type="submit" class="btn btn-success">Generar Grafica</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="list-librosleidos" role="tabpanel" aria-labelledby="list-settings-list">
          <div class="container">
            <div class="row">
              <div id="mostrar_tipo">
                <div id="librosleidos">
                  <h4 class="text-center">Estadistica por libros más leídos</h4>
                  <form action="/estadistica/categoria" method="GET">
                    <div class="form-group">
                      <label for="fechaInicio">Fecha de inicio:</label>
                      <input id="fechaInicio" class="form-control" type="date" name="fecha_inicio">
                    </div>
                    <div class="form-group">
                      <label for="fechaFin">Fecha de fin:</label>
                      <input id="fechaFin" class="form-control" type="date" name="fecha_fin">
                    </div>
                    <button type="submit" class="btn btn-success">Generar Grafica</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
{% endblock  %}
<!-- Quité el mostrar_tipo porque dividí cada estadítica por separado, como lo entendí se generaban
las estadísticas de categorías y subcategorías en una misma página con este método. De igual forma
pondré el div abajo de esto como comentario por si lo querés volver a poner.
{% block extraJS %}
<<script>
    $(document).ready(function(){
        $('#tipo').on('change',function(){
            var valor = $(this).val();
            $('#mostrar_tipo').children('div').hide();
            $('#mostrar_tipo').children('#'+valor).show();
        })
    });
</script>
{% endblock %}
-->
<!--
<div class="form-group">
                            <label for="tipo">Seleccione el tipo de estadistica a generar</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="categoria">Categoria</option>
                                <option value="subcategoria">subcategoria</option>
                            </select>
                        </div>
-->
