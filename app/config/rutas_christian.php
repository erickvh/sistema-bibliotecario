<?php
/*rutas formatos*/
$router->addPost('/formato','Formato::index');
// $router->addPost('/formato','Formato::crear'); //Crear Formato
$router->addPost(
    '/:int',
    [
        'controller' => 'formato',
        'action'     => 'editar',
        'id'     => 3
    ]); // Ruta Editar formato
$router->addPost(
    '/:int',
    [
        'controller' => 'formato',
        'action'     => 'eliminar',
        'id'     => 3
    ]); // Ruta Eliminar formato    

/*rutas recursos*/
$router->add('/recurso','Recurso::index');
$router->addPost('/recurso/crear','Recurso::crear');
$router->addPost(
    '/:int',
    [
        'controller' => 'recurso',
        'action'     => 'editar',
        'id'     => 3
    ]);
$router->addPost(
    '/:int',
    [
        'controller' => 'recurso',
        'action'     => 'eliminar',
        'id'     => 3
    ]);

//Categoria
$router->add('/categoria','Categoria::index');
$router->addPost('/categoria/crear','Categoria::crear');
$router->addPost('/categoria/editar/:int','Categoria::editar');
$router->addPost('/categoria/eliminar/:int','Categoria::eliminar');

//Subcategoria
$router->add('/subcategoria/','Subcategoria::index');
$router->addPost('/subcategoria/crear','Subcategoria::crear');
$router->addPost('/subcategoria/editar/:int','Subcategoria::editar');
$router->addPost('/subcategoria/eliminar/:int','Subcategoria::eliminar');