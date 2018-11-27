{% extends 'layouts/prestamista.volt' %}
{% block titulo %} Búsqueda
{% endblock %}
{% block iconActual%}
<h1><i class="fa fa-search"></i> Búsqueda </h1>
{% endblock %}

{% block contenido %} 
<div class="tile">
            <div class="row">
              <div class="col-lg-6">
                <form action="/busqueda-avanzada/resultados" method="GET">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ingrese el titulo</label>
                    <input class="form-control" id="exampleInputEmail1" name='titulo'  placeholder="Ingrese titulo">
                  </div>
                  <div class="form-group">
                    <label for="select">Seleccione categoria</label>
                    <select class="form-control" id="categorias" name='categoria'>
                      <option selected value>Seleccione una categoria</option>
                                    {% for categoria in categorias %}
                                       <option value='{{categoria.id}}'> {{categoria.nombre}} </option>
                                    {% endfor %}
                    </select>
                  </div>
                <div class="form-group">
                    <label for="select">Seleccione subcategoria</label>
                    <select class="form-control" id='subcategorias'  name='subcategoria'>    
                        <option selected value>Seleccione subcategoria</option>
                        
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="recurso">seleccione tipo de recurso</label>
                    <select class="form-control" id="exampleSelect1" name='recurso'>
                      <option selected value>selecione recurso</option>
                      <option value='libro'>Libro</option>
                      {% for tipo in tipos %}
                          <option value='{{tipo.id}}'> {{tipo.tipoformato}} </option>
                      {% endfor %}

                    </select>
                  </div>
              </div>
            </div>

            <div class="tile-footer">
              <button class="btn btn-primary" type="submit">Busqueda avanzada  <i class='fa fa-search'></i></button>
            </div>
            </form>
          </div>
          <div id='t'>
          </div>
{% endblock %}
{% block extraJS %}
<script>
    let  subcategoriasSelect= document.getElementById('subcategorias');
    let categorias= document.getElementById('categorias');
    subcategoriasSelect.disabled=true;
    categorias.addEventListener('change', function(){
      if(categorias.value!=''){
        
              fetch('/subcategories?id='+categorias.value)
              .then(response => response.json())
              .then(function(subcategorias)
              {
                        if(subcategorias.length!=0)
                        {
                              let subcategoriesHTML=``;
                                subcategorias.forEach(function(subcategoria)
                                {
                                            subcategoriesHTML+=`
                                            <option value=${subcategoria.id}>${subcategoria.nombre} </option>
                                                                `;
                                });
                                
                                subcategoriasSelect.innerHTML=subcategoriesHTML;  
                                subcategoriasSelect.disabled=false; 
                         }
                        else
                        {
                          subcategoriasSelect.innerHTML='<option value>La categoria no posee contenido</option>';
                          subcategoriasSelect.disabled=true;
                        }
            });
      }else{
        subcategoriasSelect.disabled=true;
        subcategoriasSelect.innerHTML='<option value>No ha escogido categoria con contenido</option>'
      }

     });

</script>
{% endblock %}