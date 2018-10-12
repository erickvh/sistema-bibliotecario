<?php

$router->add('/biblioteca/crear','Biblioteca::crear'); //almacena por post una biblioteca

$router->add('/biblioteca/deshabilitar/:int',[
    'controller'=>'biblioteca',
    'action'=>'deshabilitar',
    'id'=>1
]);