<?php
/*rutas formatos*/
$router->add('/formato','Formato::index');
// $router->addPost('/formato','Formato::crear'); //Crear Formato
$router->addPost(
    '/:int',
    [
        'controller' => 'formato',
        'action'     => 'editar',
        'id'     => 1
    ]); // Ruta Editar formato
$router->addPost(
    '/:int',
    [
        'controller' => 'formato',
        'action'     => 'eliminar',
        'id'     => 1
    ]); // Ruta Eliminar formato    

/*rutas recursos*/
$router->add('/recurso','Recurso::index');
$router->add('/recurso/crear','Recurso::crear');
$router->add(
    '/recurso/editar/:int',
    [
        'controller' => 'recurso',
        'action'     => 'editar',
        'id'     => 1
    ]);
$router->add(
    '/recurso/eliminar/:int',
    [
        'controller' => 'recurso',
        'action'     => 'eliminar',
        'id'     => 1
    ]);

//Categoria
$router->add('/categoria','Categoria::index');
$router->add('/categoria/crear','Categoria::crear');
$router->add('/categoria/editar/:int',[
    'controller'=>'categoria',
    'action'=>'editar',
    'id'=>1
]);
$router->add('/categoria/eliminar/:int',[
    'controller'=>'categoria',
    'action'=>'eliminar',
    'id'=>1
]);

//Subcategoria
$router->add('/subcategoria','Subcategoria::index');
$router->add('/subcategoria/crear','Subcategoria::crear');
$router->add('/subcategoria/editar/:int',[
    'controller'=>'subcategoria',
    'action'=>'editar',
    'id'=>1
]);
$router->add('/subcategoria/eliminar/:int',[
    'controller'=>'subcategoria',
    'action'=>'eliminar',
    'id'=>1
]);

//Perfil
$router->add('/perfil','Perfil::index');
$router->add('/perfil/cambiar','Perfil::cambiar');