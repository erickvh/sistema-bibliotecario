<?php

/**
 * Rutas login
 */

$router->addGet('/','Index::index');
$router->addPost('/','Index::login');
$router->addGet('/logout','Index::logout');

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
    'controller'=>'Autor',
    'action'=>'show',
    'id'=>1
]);

$router->addGet('/autor/editar/:int',[
    'controller'=>'Autor',
    'action'=>'edit',
    'id'=>1
]); //vista de edicion para actualizar

$router->addPost('/autor/:int',[
    'controller'=>'Autor',
    'action'=>'update',
    'id'=>1
]);//actualiza por post

$router->add('/autor/borrar/:int',[
    'controller'=>'Autor',
    'action'=>'delete',
    'id'=>1
]);//borra el contenido

/**
 * Rutas Bibliotecario
 */

<<<<<<< HEAD
$router->addGet('/bibliotecarios','UsuarioBibliotecario::index'); //muestra el datatable con ciertos atributos
$router->addPost('/bibliotecarios','UsuarioBibliotecario::store'); //almacena por post un autor
$router->addGet('/bibliotecarios/show/:int',[
        'controller'=>'UsuarioBibliotecario',
=======
$router->addGet('/bibliotecarios','Bib::index'); //muestra el datatable con ciertos atributos
$router->addPost('/bibliotecarios','Bib::store'); //almacena por post un autor
$router->addGet('/bibliotecarios/show/:int',[
        'controller'=>'Bib',
>>>>>>> master
        'action'=>'show',
        'id'=>1
]);
$router->addGet('/bibliotecarios/editar/:int',[
<<<<<<< HEAD
    'controller'=>'UsuarioBibliotecario',
=======
    'controller'=>'Bib',
>>>>>>> master
    'action'=>'edit',
    'id'=>1
]); //vista de edicion para actualizar
$router->addPost('/bibliotecarios/:int',[
<<<<<<< HEAD
    'controller'=>'UsuarioBibliotecario',
=======
    'controller'=>'Bib',
>>>>>>> master
    'action'=>'update',
    'id'=>1

]);//actualiza por post
$router->add('/bibliotecarios/deshabilitar/:int',[
<<<<<<< HEAD
    'controller'=>'UsuarioBibliotecario',
=======
    'controller'=>'Bib',
>>>>>>> master
    'action'=>'deshabilitar',
    'id'=>1
]);//deshabilita el contenido

<<<<<<< HEAD
$router->addGet('/bibliotecarios/crear','UsuarioBibliotecario::create');
=======
$router->addGet('/bibliotecarios/crear','Bib::create');
>>>>>>> master

/** 
 * Logica fuera de los controladores
 */
$router->notFound([
    'controller'=>'Error',
    'action'=>'mostrar404'
    ]);
    
$router->addGet('/401','Error::mostrar401');