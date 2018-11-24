{% extends 'layouts/prestamista.volt' %}
{% block titulo %} Resultados
{% endblock %}
{% block iconActual%}
<h1><i class="fa fa-search"></i> Resultados de la búsqueda </h1>
{% endblock %}
{% block extraCSS %}
<style>
    table th {
        border: hidden;
    }
    
    table tr {
        border: hidden;
    }
</style>
{% endblock %}
{% block contenido %}
    {% if recursos %}
    <table id="tabResultados" class="table">
        <thead>
            <th></th>
        </thead>
    <tbody>
        {% for recurso in recursos %}
        <tr>
            <td>
            <div class="container" style="padding-left: 10%; padding-right: 10%;"> 
            <div class="row" style="border-style:solid; border-width: 1px; padding-left: 2%; padding-right: 2%;">
                <div class="col col-md-2">
                <br>
                    {% if recurso.MaterialesBibliograficos.imagenurl %}
                        <img width="140px" height="140px" src='{{recurso.MaterialesBibliograficos.imagenurl}}' {{recurso.MaterialesBibliograficos.nombreimagen ? "alt='"~recurso.MaterialesBibliograficos.nombreimagen~"'":'no disponible'}} />
                    {% else %}
                        <img src='https://via.placeholder.com/140x140?text=No disponible' alt='logo no disponible'/> 
                    {% endif %}
                <br>
                </div>
                <div class="col col-md-1"></div>
                <div class="col col-md-6">
                <br>
                    <h5><p>{{recurso.materialesbibliograficos.nombre}}</p></h5>
                    <?php $i=1 ?>
                    <p>Autor: {% for mataut in matautores %} {% if mataut.idmaterial == recurso.idmaterial %} {% if i!= 1 %} , {% endif %} <?php $i=$i+1?> {{mataut.autores.nombre}} {% endif %} {% endfor %}</p>
                    {% if recurso.materialesbibliograficos.fechapublicacion %}
                        <p>Fecha de publicación: {{recurso.materialesbibliograficos.fechapublicacion}}</p>
                    {% else %}
                        <p>Fecha de publicación: No definida</p>
                    {% endif %}
                    <p style="padding-left: 40%; border-radius: 10px 10px 10px 10px;-moz-border-radius: 10px 10px 10px 10px;-webkit-border-radius: 10px 10px 10px 10px; border: 1px solid rgb(236, 70, 120); background-color: rgb(236, 70, 120)">{{recurso.formatos.tipoformato}}</p>
                <br>
                </div>
                <div class="col col-md-1"></div>
                <div class="col col-md-1">
                    <br>
                    <a href="{{url('busqueda/verRecurso/'~ recurso.id)}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> Ver </a>
                </div>
            </div>
            </div>
        </td>
        </tr>
        {% endfor %}
    </tbody>
        </table>
    {% else %}
        <h5>Búsqueda sin resultados</h5>
    {% endif %}
    

{% endblock %}

{% block extraJS %}
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$('#tabResultados').DataTable({
    'language': {
        'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
    },
    "searching": false,
    "info": false,
    "pageLength": 5,
    "lengthChange": false
});
</script>
{% endblock %}