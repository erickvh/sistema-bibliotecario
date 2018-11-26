<?php

$router->add('/biblioteca/crear','Biblioteca::crear'); //almacena por post una biblioteca

$router->add('/biblioteca/deshabilitar/:int',[
    'controller'=>'Biblioteca',
    'action'=>'deshabilitar',
    'id'=>1
]);
/* rutas Lector*/
$router->addGet('/lector','Lector::index');

$router->add('/lector/crear','Lector::crear');// crear el lector

$router->add('/lector/deshabilitar/:int',[
    'controller'=>'Lector',
    'action'=>'deshabilitar',
    'id'=>1
]);//deshabilita el lector

$router->addGet('/lector/ver/:int',[
    'controller'=>'Lector',
    'action'=>'ver',
    'id'=>1
]);//visualizar los datos del lector

$router->add('/lector/editar/:int',[
    'controller'=>'Lector',
    'action'=>'editar',
    'id'=>1
]); //vista de edicion para actualizar

