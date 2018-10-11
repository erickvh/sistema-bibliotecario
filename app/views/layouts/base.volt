<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">

    <title>{% block titulo %} Escoja un titulo {% endblock %}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <!-- custom css -->
    {% block extraCSS %} {% endblock %}
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">

    <header class="app-header"><a class="app-header__logo" href="index.html">Biblioteca</a>
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->


        {% block navegacion %} {% endblock %}


        <main class="app-content">
            <div class="app-title">
                <div>
                    {% block iconActual %} aqui va el icono actual {% endblock %}
                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    {% block breadcrumb %} {% endblock %}
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            {{ flashSession.output() }}
                            {% block contenido %} conenido principal {% endblock %}
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Essential javascripts for application to work-->
        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/main.js"></script>
        {% block extraJS %} {% endblock %}
        <!-- The javascript plugin to display page loading on top-->
        <script src="/js/plugins/pace.min.js"></script>
        <!-- Page specific javascripts-->

</body>

</html>