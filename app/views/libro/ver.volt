{% extends 'layouts/bibliotecario.volt' %} 
{% block titulo %} Ver Libro {{libro.id}} {% endblock %}
{% block iconActual %}
<h1><i class="fa fa-book"></i>Libro</h1>
<p></p>
{% endblock %} 


{% block contenido %}
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Datos de Libro</h3>
            
            <div align= "center">
            {% if libro.MaterialesBibliograficos.imagenurl %}
            <img src='{{libro.MaterialesBibliograficos.imagenurl}}' {{libro.MaterialesBibliograficos.nombreimagen ? "alt='"~libro.MaterialesBibliograficos.nombreimagen~"'":'no disponible'}} />
            {% else %}
            <img src='https://via.placeholder.com/140x140' alt='logo no disponible'/> 
            {% endif %}
            </div>
            <br>
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input name="nomLibro" class="form-control" type="text" placeholder="Nombre" value="{{libro.Materialesbibliograficos.nombre}}"  readonly>
                </div>
                <div class="form-group">
                    <label class="control-label">Descripción</label>
                    <textarea name="descLibro" cols="30" rows="3" class="form-control" readonly>{{libro.MaterialesBibliograficos.descripcion}}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Editorial</label>
                    <input name="editLibro" class="form-control" type="text" placeholder="Editorial" value="{{libro.editorial}}" readonly>
                </div> 
                 <div class="form-group">
                    <label class="control-label">Volumen</label>
                    <input name="volLibro" class="form-control" type="text" placeholder="Volumen" value="{{libro.volumen}}" readonly>
                </div>  
                 <div class="form-group">
                    <label class="control-label">Sinopsis</label>
                    <textarea name="sinLibro" cols="30" rows="3" class="form-control" readonly>{{libro.sinopsis}}</textarea>
                </div> 
                 <div class="form-group">
                    <label class="control-label">Fecha de publicación</label>
                    <input name="fpub" id="fpub" class="form-control" type="date" value="{{libro.Materialesbibliograficos.fechapublicacion}}" min="1700-01-01" readonly>
                </div>
                <div class="form-group">
                    <label class="control-label">Es de consulta externa</label>
                    <input  name="exLibro" type="checkbox" {% if libro.Materialesbibliograficos.esexterno %} checked {% endif %} disabled>
                </div>

                <div class="form-group">
                    <label class="control-label">Subcategoria</label>
                    <select name="subLibro" id="subLibro" class="form-control" disabled>
                        {% for s in subcategorias %}
                        <option value="{{s.id}}" {% if libro.Materialesbibliograficos.Subcategorias.id == s.id %} 
                        selected {% endif %}>{{s.categorias.nombre}} : {{s.nombre}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Autores</label>
                    <select  name="autoresLibro[]" id="autoresLibro" class="form-control select2-multiple" multiple="multiple" disabled>
                        {% for a in autores %}
                        <option value="{{a.id}}" {% for ma in mataut %} {% if ma.idautor == a.id %} selected {% endif %}{% endfor %}>{{a.nombre}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Unidades Existentes</label>
                    <input type="number" name="cantidadLibro" class="form-control" value="{{unidades.unidadesexistentes}}" readonly>
                </div>            
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

