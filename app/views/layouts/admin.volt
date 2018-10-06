{%  extends 'layouts/base.volt' %}

{%  block titulo %} Panel Administrador {% endblock %}

{% block navegacion %}
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="page-login.html"><i class="fa fa-sign-out fa-lg"></i>Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </header>

    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
    
      <ul class="app-menu">
        <li><a class="app-menu__item" href="index.html"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Panel Bibliotecario</span></a></li>
        <li><a class="app-menu__item" href="biblioteca"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Gestionar Bibliotecas</span></a></li>
        <li><a class="app-menu__item" href="charts.html"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Gestionar Bibliotecarios</span></a></li>
      </ul>
    </aside>
{% endblock %}

{% block iconActual %}
    <h1><i class="fa fa-dashboard"></i> Panel Administrador</h1>
    <p>Panel dedicado al Administrador del sistema</p>
{% endblock %}

{% block contenido %}


{% endblock %}
