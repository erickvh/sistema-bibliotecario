<?php

/*rutas biblioteca*/
$router->add('/biblioteca','Biblioteca::index');
$router->add(
    '/biblioteca/editar/:int',
    [
        'controller' => 'Biblioteca',
        'action'     => 'editar',
        'id'     => 1
    ]);

$router->addGet('/biblioteca/ver/:int',[
        'controller'=>'Biblioteca',
        'action'=>'ver',
        'id'=>1
]);


/*rutas libro*/
$router->addGet('/libro','Libro::index');
$router->add(
    '/libro/editar/:int',
    [
        'controller' => 'Libro',
        'action'     => 'editar',
        'id'     => 1
    ]);
$router->add('/libro/crear','Libro::crear');

$router->add(
    '/libro/eliminar/:int',
    [
        'controller' => 'Libro',
        'action'     => 'eliminar',
        'id'     => 1
    ]);

$router->addGet('/libro/ver/:int',[
        'controller'=>'Libro',
        'action'=>'ver',
        'id'=>1
]);
