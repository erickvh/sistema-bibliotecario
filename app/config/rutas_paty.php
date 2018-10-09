<?php

/*rutas biblioteca*/
$router->addGet('/biblioteca','Biblioteca::index');
$router->addPost(
    '/biblioteca/editar/{0-9}',
    [
        'controller' => 'biblioteca',
        'action'     => 'editar',
        'id'     => 3
    ]);


/*rutas libro*/
$router->addGet('/libro','Libro::index');
$router->addPost(
    '/libro/editar/{0-9}',
    [
        'controller' => 'libro',
        'action'     => 'editar',
        'id'     => 3
    ]);
$router->addPost('/libro/crear','Libro::crear');
$router->addPost(
    '/:int',
    [
        'controller' => 'libro',
        'action'     => 'eliminar',
        'id'     => 3
    ]);
