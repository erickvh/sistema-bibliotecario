{% extends 'layouts/prestamista.volt' %}
{% block titulo %} Búsqueda
{% endblock %}
{% block iconActual%}
<h1><i class="fa fa-search"></i> Búsqueda </h1>
{% endblock %}

{% block contenido %} 
    <div class="container">
        <div class="row">
            <div class="col">
                <form class="row" action="{{url('busqueda')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-11">
                        <input class="form-control" name="busqueda" class="form" type="text" placeholder="búsqueda" required>
                    </div>
                    <div class="form-group col-md-1 align-self-end">
                        <input type="submit" class="text-center btn btn-primary" value="Buscar">
                    </div>
                    <div class="form-group col-md-3" style="padding-left:10%;">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="formaBuscar" value="autor" checked>Autor
                        </label>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="formaBuscar" value="titulo">Titulo
                        </label>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="formaBuscar" value="isbn">ISBN
                        </label>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="formaBuscar" value="otros">Otros Recursos
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br><br>
    <div class="container">
        <div class="row" style="padding-left: 4%; padding-right: 4%">
            <div class="col col-md-5" style="border-style:solid; border-width: 1px;">
                <br>
                <h5><i class="fa fa-user fa-lg"></i>  Búsqueda de libros por Autor</h5>
                <br>
                <h6><p>Para buscar el libro puedes hacerlo digitando el nombre del autor en la barra de búsqueda</p></h6>
            </div>
            <div class="col col-md-1"></div>
            <div class="col col-md-5" style="border-style:solid; border-width: 1px;">
                <br>
                <h5><i class="fa fa-book fa-lg"></i>  Búsqueda de libros por Titulo</h5>
                <br>
                <h6><p>Busca el libro de interes escribiendo el titulo completo</p></h6>
            </div>
        </div>
        <br>
        <div class="row" style="padding-left: 4%; padding-right: 4%">
            <div class="col col-md-5" style="border-style:solid; border-width: 1px;">
                <br>
                <h5><i class="fa fa-book fa-lg"></i>  Búsqueda de libros por ISBN</h5>
                <br>
                <h6><p>Búsqueda especializada para encontrar un libro especifico</p></h6>
            </div>
            <div class="col col-md-1"></div>
            <div class="col col-md-5" style="border-style:solid; border-width: 1px;">
                <br>
                <h5><i class="fa fa-map fa-lg"></i>  Búsqueda de otros Recursos</h5>
                <br>
                <h6><p>Para buscar otros recursos bibliográficos como CD, DVD, Mapas, Tesis, Revistas, Planos, Hemerotecas, ingresa el tema o titulo de interes.</p></h6>
            </div>
        </div>
    </div>

{% endblock %}