{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Editar Libro {{libro.id}} {% endblock %}
{% block iconActual %}
<h1><i class="fa fa-book"></i>Libro</h1>
<p></p>
{% endblock %} 


{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Editar</h3>
            <form action="" method="post" enctype="multipart/form-data">
            
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nomLibro" class="form-control" type="text" placeholder="Nombre" value="{{libro.Materialesbibliograficos.nombre}}"  >
                </div>
                <div class="form-group">
                    <label class="control-label">Descripción</label>
                    <textarea name="descLibro" cols="30" rows="3" class="form-control">{{libro.MaterialesBibliograficos.descripcion}}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Editorial</label>
                    <input name="editLibro" class="form-control" type="text" placeholder="Editorial" value="{{libro.editorial}}">
                </div> 
                 <div class="form-group">
                    <label class="control-label">Volumen</label>
                    <input name="volLibro" class="form-control" type="text" placeholder="Volumen" value="{{libro.volumen}}">
                </div>  
                 <div class="form-group">
                    <label class="control-label">Sinopsis</label>
                    <textarea name="sinLibro" cols="30" rows="3" class="form-control">{{libro.sinopsis}}</textarea>
                </div> 
                 <div class="form-group">
                    <label class="control-label">Fecha de publicación</label>
                    <input name="fpub" id="fpub" class="form-control" type="date" value="{{libro.Materialesbibliograficos.fechapublicacion}}">
                </div>
                <div class="form-group">
                    <label class="control-label">Es de consulta externa</label>
                    <input  name="exLibro" type="checkbox" {% if libro.Materialesbibliograficos.esexterno %} checked {% endif %}>
                </div>
                
                <div class="form-group">
                    <label class="control-label">Nombre de la imagen</label>
                    <input  name="nomImgLibro" type="text" class="form-control" placeholder="Nombre de imagen" value="{{libro.Materialesbibliograficos.nombreimagen}}">
                </div> 
                <div class="form-group">
                    <label for="imagenLibro">Imagen</label>
                    <input name="imagenLibro" class="form-control-file" id="imagenLibro" type="file" aria-describedby="fileHelp"><small class="form-text text-muted" id="fileHelp">Seleccione la imagen del libro.</small>
                  </div>

                <div class="form-group">
                    <label class="control-label">Subcategoria</label>
                    <select name="subLibro" id="subLibro" class="form-control">
                        {% for s in subcategorias %}
                        <option value="{{s.id}}" {% if libro.Materialesbibliograficos.Subcategorias.id == s.id %} 
                        selected {% endif %}>{{s.categorias.nombre}} : {{s.nombre}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Autores</label>
                    <select  name="autoresLibro[]" id="autoresLibro" class="form-control select2-multiple" multiple="multiple">
                        {% for a in autores %}
                        <option value="{{a.id}}" {% for ma in mataut %} {% if ma.idautor == a.id %} selected {% endif %}{% endfor %}>{{a.nombre}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Unidades Existentes</label>
                    <input type="number" name="cantidadLibro" class="form-control" value="{{unidades.unidadesexistentes}}">
                </div>             
                <input type="submit" class="text-center btn btn-primary" value="Guardar">
            </form>
        </div>
    </div>
</div>
{% endblock %}

{% block extraJS %} 
<script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>


<script type="text/javascript">
      
      $('#autoresLibro').select2(); 


</script>

{% endblock %}

