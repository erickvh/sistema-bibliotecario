<?php

$router = $di->getRouter();
/* routing login */

$router->addGet('/','Index::index');

$router->addPost('/','Index::login');

$router->addGet('/prueba/prueba','Prueba::index'); //ruta para pruebas con controlador de la misma manera

/*routing menu*/
$router->addGet('/administrador','Menu::admin');
$router->addGet('/bibliotecario','Menu::bibliotecario');

/*routing biblioteca*/
$router->addGet('/biblioteca','Biblioteca::consultar');
$router->addPost(
    '/biblioteca/editar/{0-9}',
    [
        'controller' => 'biblioteca',
        'action'     => 'editar',
        'id'     => 3
    ]);

/*routing libro*/
$router->addGet('/libro','Libro::consultar');
/*rutas formatos*/
$router->addPost('/formato','Formato::index');
// $router->addPost('/formato','Formato::crear'); //Crear Formato
$router->addPost(
    '/formato/editar/{0-9}',
    [
        'controller' => 'formato',
        'action'     => 'editar',
        'id'     => 3
    ]); // Ruta Editar formato
$router->addPost(
    '/:int',
    [
        'controller' => 'formato',
        'action'     => 'eliminar',
        'id'     => 3
    ]); // Ruta Eliminar formato    

/*rutas recursos*/
$router->addPost('/recurso','Recurso::index');
$router->addPost(
    '/recurso/editar/{0-9}',
    [
        'controller' => 'recurso',
        'action'     => 'editar',
        'id'     => 3
    ]); // Ruta Editar formato


$router->handle();
