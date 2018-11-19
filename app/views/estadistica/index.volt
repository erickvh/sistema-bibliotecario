{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Estadisticas
{% endblock %}
{% block iconActual %}
<h1> Ver Recurso </h1>
<p>Detalles del Recurso</p>
{% endblock %}

{% block contenido %}
<div class="row">
    <div class="col-4">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-categoria" role="tab" aria-controls="home">Estadisticas Por Categoria</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
      </div>
    </div>
    <div class="col-8">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-categoria" role="tabpanel" aria-labelledby="list-home-list">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3 class="text-center">Estadisticas por categoria </h3>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="anio">Text</label>
                                <input id="anio" class="form-control" type="numbre">
                            </div>
                            <div class="form-group">
                                <label for="fechaInicio">Mes de inicio </label>
                                <input id="fechaInicio" class="form-control" type="number">
                            </div>
                            <div class="form-group">
                                <label for="fechaFin">Mes de Fin</label>
                                <input id="fechaFin" class="form-control" type="numbe">
                            </div>
                            <button type="submit" class="btn btn-success">Generar Grafica</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">...</div>
        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
      </div>
    </div>
  </div>
{% endblock  %}
     