{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Crear Libro {% endblock %}
{% block iconActual %}
<h1><i class="fa fa-book"></i>Libro</h1>
<p></p>
{% endblock %}


{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Crear</h3>
            <form action="" method="post">
            
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nomLibro" class="form-control" type="text" placeholder="Nombre" value="" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Descripción</label>
                    <textarea name="descLibro" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Editorial</label>
                    <input name="editLibro" class="form-control" type="text" placeholder="Editorial" value="">
                </div> 
                 <div class="form-group">
                    <label class="control-label">Volumen</label>
                    <input name="volLibro" class="form-control" type="text" placeholder="Volumen" value="">
                </div>  
                 <div class="form-group">
                    <label class="control-label">Sinopsis</label>
                    <textarea name="sinLibro" cols="30" rows="3" class="form-control"></textarea>
                </div> 
                 <div class="form-group">
                    <label class="control-label">Fecha de publicación</label>
                    <input name="fpub" id="fpub" class="form-control" type="date" value="">
                </div>
                <div class="form-group">
                    <label class="control-label">Es de consulta externa</label>
                    <input  name="exLibro" type="checkbox">
                </div>
                
                <div class="form-group">
                    <label class="control-label">Nombre de la imagen</label>
                    <input  name="nomImgLibro" type="text" class="form-control" placeholder="Nombre de imagen" value="">
                </div> 
                <div class="form-group">
                    <label for="imagenLibro">Imagen</label>
                    <input name="imagenLibro" class="form-control-file" id="imagenLibro" type="file" aria-describedby="fileHelp"><small class="form-text text-muted" id="fileHelp">Seleccione la imagen del libro.</small>
                  </div>
                <!--<div class="form-group">
                    <label class="control-label">Categoria</label>
                    <select name="catLibro" id="catLibro" class="form-control">
                        {% for c in categorias %}
                        <option value="{{c.id}}"></option>
                        {% endfor %}
                    </select>
                </div>-->
                <div class="form-group">
                    <label class="control-label">Subcategoria</label>
                    <select name="subLibro" id="subLibro" class="form-control">
                        {% for s in subcategorias %}
                        <option value="{{s.id}}">{{s.nombre}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Autores</label>
                    <select  name="autoresLibro[]" id="autoresLibro" class="form-control select2-multiple" multiple="multiple" required>
                        {% for a in autores %}
                        <option value="{{a.id}}">{{a.nombre}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Unidades Existentes</label>
                    <input type="number" name="cantidadLibro" class="form-control" value="{{unidades.unidadesexistentes}}" required>
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

