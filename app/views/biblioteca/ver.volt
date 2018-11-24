{% extends 'layouts/admin.volt' %} 
{% block titulo %} Ver Biblioteca {{biblioteca.id}} {% endblock %}
{% block iconActual %}
<h1><i class="fa fa-cog"></i> Biblioteca </h1>
<p>Mostrar biblioteca</p>
{% endblock %} 
{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Datos de Biblioteca</h3>
                <div align= "center">
                    {% if biblioteca.logourl %}
                    <img width="140px" height="140px" src='{{biblioteca.logourl}}' {{biblioteca.nombrelogo ? "alt='"~biblioteca.nombrelogo~"'":'no disponible'}} />
                    {% else %}
                    <img src='https://via.placeholder.com/140x140?text=No disponible' alt='logo no disponible'/> 
                    {% endif %}
                </div>
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nombreBiblioteca" class="form-control" type="text" placeholder="Nombre" value="{{biblioteca.nombre}}"  readonly >
                </div>
                <div class="form-group">
                    <label class="control-label">Ubicación</label>
                    <input name="ubicacionBiblioteca" class="form-control" type="text" placeholder="Ubicación" value="{{biblioteca.ubicacion}}" readonly  >
                </div>
                <div class="form-group">
                    <label class="control-label">Teléfono</label>
                    <input name="telefonoBiblioteca" class="form-control" type="text" placeholder="Teléfono" value="{{biblioteca.telefono}}" readonly  >
                </div> 
                 <div class="form-group">
                    <label class="control-label">Clasificación</label>
                    <input name="clasBiblioteca" class="form-control" type="text" placeholder="Clasificación" value="{{biblioteca.clasificacion}}" readonly>
                </div>  
                 <div class="form-group">
                    <label class="control-label">Email</label>
                    <input name="emailBiblioteca" class="form-control" type="email" placeholder="Email" value="{{biblioteca.email}}" readonly>
                </div>              
        </div>
    </div>
</div>
{% endblock %}