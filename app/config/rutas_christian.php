<?php
/*rutas formatos*/
$router->add('/formato','Formato::index');
// $router->addPost('/formato','Formato::crear'); //Crear Formato
$router->add(
    '/formato/editar/:int',
    [
        'controller' => 'Formato',
        'action'     => 'editar',
        'id'     => 1
    ]); // Ruta Editar formato
$router->add(
    '/formato/eliminar/:int',
    [
        'controller' => 'Formato',
        'action'     => 'eliminar',
        'id'     => 1
    ]); // Ruta Eliminar formato    

/*rutas recursos*/
$router->add('/recurso','Recurso::index');
$router->add('/recurso/crear','Recurso::crear');
$router->add(
    '/recurso/editar/:int',
    [
        'controller' => 'Recurso',
        'action'     => 'editar',
        'id'     => 1
    ]);
$router->add(
    '/recurso/eliminar/:int',
    [
        'controller' => 'Recurso',
        'action'     => 'eliminar',
        'id'     => 1
    ]);

$router->add(
    '/recurso/ver/:int',
    [
        'controller'=>'Recurso',
        'action'=>'ver',
        'id'=>1
]);

$router->add('/recurso/grafico','Recurso::graficar');

//Categoria
$router->add('/categoria','Categoria::index');
$router->add('/categoria/crear','Categoria::crear');
$router->add('/categoria/editar/:int',[
    'controller'=>'Categoria',
    'action'=>'editar',
    'id'=>1
]);
$router->add('/categoria/eliminar/:int',[
    'controller'=>'Categoria',
    'action'=>'eliminar',
    'id'=>1
]);

//Subcategoria
$router->add('/subcategoria','Subcategoria::index');
$router->add('/subcategoria/crear','Subcategoria::crear');
$router->add('/subcategoria/editar/:int',[
    'controller'=>'Subcategoria',
    'action'=>'editar',
    'id'=>1
]);
$router->add('/subcategoria/eliminar/:int',[
    'controller'=>'Subcategoria',
    'action'=>'eliminar',
    'id'=>1
]);

//Perfil
$router->add('/perfil','Perfil::index');
$router->add('/perfil/cambiar','Perfil::cambiar');