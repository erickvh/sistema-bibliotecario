<?php

/**
 * Rutas login
 */

$router->addGet('/','Index::index');
$router->addPost('/','Index::login');
$router->addGet('/logout','index::logout');

/**
 * Rutas menu
 */
$router->addGet('/administrador','Menu::admin');
$router->addGet('/bibliotecario','Menu::bibliotecario');
/**
 * Rutas autor
 */
$router->addGet('/autor','Autor::index'); //muestra el datatable con ciertos atributos
$router->addPost('/autor','Autor::store'); //almacena por post un autor

$router->addGet('/autor/show/:int',[
    'controller'=>'autor',
    'action'=>'show',
    'id'=>1
]);

$router->addGet('/autor/editar/:int',[
    'controller'=>'autor',
    'action'=>'edit',
    'id'=>1
]); //vista de edicion para actualizar

$router->addPost('/autor/:int',[
    'controller'=>'autor',
    'action'=>'update',
    'id'=>1
]);//actualiza por post

$router->add('/autor/borrar/:int',[
    'controller'=>'autor',
    'action'=>'delete',
    'id'=>1
]);//borra el contenido

/**
 * Rutas Bibliotecario
 */

$router->addGet('/bibliotecarios','usuariobibliotecario::index'); //muestra el datatable con ciertos atributos
$router->addPost('/bibliotecarios','usuariobibliotecario::store'); //almacena por post un autor
$router->addGet('/bibliotecarios/show/:int',[
        'controller'=>'usuariobibliotecario',
        'action'=>'show',
        'id'=>1
]);
$router->addGet('/bibliotecarios/editar/:int',[
    'controller'=>'usuariobibliotecario',
    'action'=>'edit',
    'id'=>1
]); //vista de edicion para actualizar
$router->addPost('/bibliotecarios/:int',[
    'controller'=>'usuariobibliotecario',
    'action'=>'update',
    'id'=>1

]);//actualiza por post
$router->add('/bibliotecarios/deshabilitar/:int',[
    'controller'=>'usuariobibliotecario',
    'action'=>'deshabilitar',
    'id'=>1
]);//deshabilita el contenido

$router->addGet('/bibliotecarios/crear','usuariobibliotecario::create');

/** 
 * Logica fuera de los controladores
 */
$router->notFound([
    'controller'=>'error',
    'action'=>'mostrar404'
    ]);
    
$router->addGet('/401','error::mostrar401');