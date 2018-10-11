<?php

$router = $di->getRouter();

/* routing login */

$router->addGet('/','Index::index');

$router->addPost('/','Index::login');

$router->addGet('/prueba/prueba','Prueba::index'); //ruta para pruebas con controlador de la misma manera

/*routing menu*/
$router->addGet('/administrador','Menu::admin');
$router->addGet('/bibliotecario','Menu::bibliotecario');

  
// se integraran despues para evitar conflictos

require_once('rutas_erick.php'); 
require_once('rutas_vero.php');
require_once('rutas_paty.php');
require_once('rutas_christian.php');
require_once('rutas_axel.php');


$router->handle();
