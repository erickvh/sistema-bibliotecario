<?php

$router = $di->getRouter();
/* routing login */

$router->addGet('/','Index::index');

$router->addPost('/','Index::login');

$router->addGet('/prueba','Prueba::index'); //ruta para pruebas con controlador de la misma manera

/*routing menu*/
$router->addGet('/administrador','Menu::admin');
$router->addGet('/bibliotecario','Menu::bibliotecario');

/*rutas formatos*/
$router->addGet('/formato','Formato::index');







$router->handle();
