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

/*rutas gestion de prestamos*/
$router->addGet('/reserva','Prestamo::index');
$router->addGet('/prestamo','Prestamo::consultarPrestamos');
$router->add(
    '/reserva/cancelar/:int',
    [
        'controller' => 'Prestamo',
        'action'     => 'cancelarReserva',
        'id'     => 1
    ]);
$router->add(
    '/reserva/prestar/:int',
    [
        'controller' => 'Prestamo',
        'action'     => 'prestar',
        'id'     => 1
    ]);
    
$router->add(
    '/prestamo/devolver/:int',
    [
        'controller' => 'Prestamo',
        'action'     => 'devolver',
        'id'     => 1
    ]);

/*rutas de busqueda*/
$router->add('/busqueda','Busqueda::index');
$router->add('/busquedaGeneral','Busqueda::busqueda');

$router->addGet('/busqueda/ver/:int',[
    'controller'=>'Busqueda',
    'action'=>'verLibro',
    'id'=>1
]);

$router->addGet('/busqueda/verRecurso/:int',[
    'controller'=>'Busqueda',
    'action'=>'verRecurso',
    'id'=>1
]);

$router->addPost('/busqueda/reservar/:int',[
    'controller'=>'Busqueda',
    'action'=>'reservar',
    'id'=>1
]);