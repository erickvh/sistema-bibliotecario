<?php
/*
$router->addPost(
    '/biblioteca/crear',
    [
        'controller' => 'biblioteca',
        'action'     => 'crear',
        'id' => 3,
    ]); // Ruta para crear biblioteca 
*/
// $router->addGet('/biblioteca/crear','Biblioteca::crear');
$router->addPost('/biblioteca/crear','Biblioteca::crear'); //almacena por post una biblioteca