{% extends 'layouts/bibliotecario.volt' %}
{% block titulo %} Gráfico
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
            <h2 class="text-center">Gráfico por zona geográfica</h2>
            <h5 class="text-center">Desde la fecha: {{fecha_inicio}} hasta la fecha: {{fecha_fin}}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3 class="text-center">Pastel</h3>
            <canvas id="myChart"></canvas>
        </div>
        <div class="col">
            <h3 class="text-center">Barra</h3>
            <canvas id="myChart2"></canvas>
        </div>
    </div>
</div>
{% endblock %}
{% block extraJS %}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
    var dep = {{dep|json_encode}};    
    var canDep = {{cantidad|json_encode}};    
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: dep,
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
            data: canDep,
        }]
    },
    options:
    {
        responsive: true,
        aspectRatio: 2,
    }
    });
    var ctx = document.getElementById('myChart2').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: dep,
        datasets: [{
            label: 'prestamos',
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
            data: canDep,
        }]
    },
    options:
    {
        responsive: true,
        aspectRatio: 2,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
    });
</script>
{% endblock %}
