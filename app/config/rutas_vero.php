<?php

$router->add('/biblioteca/crear','Biblioteca::crear'); //almacena por post una biblioteca

$router->add('/biblioteca/deshabilitar/:int',[
    'controller'=>'Biblioteca',
    'action'=>'deshabilitar',
    'id'=>1
]);

$router->addGet('/lector','Lector::index');

$router->add('/lector/crear','Lector::crear');

$router->add('/lector/deshabilitar/:int',[
    'controller'=>'Lector',
    'action'=>'deshabilitar',
    'id'=>1
]);