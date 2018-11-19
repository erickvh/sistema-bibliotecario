{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Grafico
{% endblock %}
{% block iconActual %}
<h1> Ver Recurso </h1>
<p>Detalles del Recurso</p>
{% endblock %} 
{% block extraCSS %} 
<style>
canvas{
    width: 50%;
    height: 50%;      
    }
</style>

{% endblock %}
{% block contenido %} 
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="text-center">Categorias</h2>
            <canvas id="myChart"></canvas>
        </div>
        <div class="col">
            <h2 class="text-center">Categorias</h2>
            <canvas id="myChart2"></canvas>
        </div>
    </div>    
</div>
{% endblock %}
{% block extraJS %} 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
    var cat = {{cat|json_encode}};
    console.log(cat);
    var canCat = {{cantidad|json_encode}};
    console.log(canCat);   
    var ctx = document.getElementById('myChart').getContext('2d');  
    var chart = new Chart(ctx, {    
    type: 'pie',    
    data: {
        labels: cat,
        datasets: [{            
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
            ],
            borderWidth: 1,
            data: canCat,
        }]
    },
    options: 
    {
        responsive: true,
        aspectRatio: 2,
    }    
    });
</script>
{% endblock %}