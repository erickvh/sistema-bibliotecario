{% extends 'layouts/base.volt' %} {% block titulo %} Panel Bibliotecario {% endblock %} 
{% block biblioteca %}
{{biblioteca.nombre}}
{% endblock %}

{% block logo %} 
{% if biblioteca.logourl %}
<img src='{{biblioteca.logourl}}' {{biblioteca.nombrelogo ? "alt='"~biblioteca.nombrelogo~"'":'no disponible'}} />
{% else %}
<img src='https://via.placeholder.com/32x32' alt='logo no disponible'/> 
{% endif %}
{% endblock %}   

{% block navegacion %}
<ul class="app-nav">
    <!-- User Menu-->
    <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="/perfil"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
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
        <li><a class="app-menu__item" href="/busqueda"><i class="app-menu__icon fa fa-search"></i><span class="app-menu__label">Búsqueda</span></a></li>
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-search-plus"></i><span class="app-menu__label">Búsqueda Avanzada</span></a></li>
        <li><a class="app-menu__item" href="/"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Mis Préstamos</span></a></li>
        <li><a class="app-menu__item" href="/"><i class="app-menu__icon fa fa-clock-o"></i><span class="app-menu__label">Mis Reservas</span></a></li>
        <li><a class="app-menu__item" href="/"><i class="app-menu__icon fa fa-history"></i><span class="app-menu__label">Mi Historial </span></a></li>

       
    </ul>
</aside>
{% endblock %} {% block iconActual %}
{% endblock %} {% block contenido %} Busqueda aqui supongo {% endblock %}