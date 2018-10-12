<?php

/*rutas biblioteca*/
$router->add('/biblioteca','Biblioteca::index');
$router->add(
    '/biblioteca/editar/:int',
    [
        'controller' => 'biblioteca',
        'action'     => 'editar',
        'id'     => 1
    ]);


/*rutas libro*/
$router->addGet('/libro','Libro::index');
$router->add(
    '/libro/editar/:int',
    [
        'controller' => 'libro',
        'action'     => 'editar',
        'id'     => 1
    ]);
$router->add('/libro/crear','Libro::crear');

$router->add(
    '/libro/eliminar/:int',
    [
        'controller' => 'libro',
        'action'     => 'eliminar',
        'id'     => 1
    ]);
