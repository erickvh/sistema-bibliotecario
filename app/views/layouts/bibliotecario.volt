{% extends 'layouts/base.volt' %} {% block titulo %} Panel Bibliotecario {% endblock %} {% block navegacion %}
<ul class="app-nav">
    <!-- User Menu-->
    <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="/logout"><i class="fa fa-sign-out fa-lg"></i>Cerrar Sesión</a></li>
        </ul>
    </li>
</ul>
</header>

<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">

    <ul class="app-menu">
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Panel Bibliotecario</span></a></li>
        <li><a class="app-menu__item" href="/libro"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Gestionar Libros</span></a></li>
        <li><a class="app-menu__item" href="/recurso"><i class="app-menu__icon fa fa-paperclip"></i><span class="app-menu__label">Gestionar recursos</span></a></li>
        <li><a class="app-menu__item" href="/categoria"><i class="app-menu__icon fa fa-list-ul"></i><span class="app-menu__label">Gestionar categorias </span></a></li>
        <li><a class="app-menu__item" href="/subcategoria"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Gestionar Subcategorias </span></a></li>
        <li><a class="app-menu__item" href="/autor"><i class="app-menu__icon fa fa-user-circle"></i><span class="app-menu__label">Gestionar Autores</span></a></li>
        <li><a class="app-menu__item" href="/formato"><i class="app-menu__icon fa fa-cubes"></i><span class="app-menu__label">Gestionar Formatos</span></a></li>
    </ul>
</aside>
{% endblock %} {% block iconActual %}
<h1><i class="fa fa-dashboard"></i> Panel Bibliotecario</h1>
<p>Panel de Bibliotecario</p>
{% endblock %} {% block contenido %} {% endblock %}