<?php
$router->addGet('/logout','index::logout');
$router->addGet('/autor','Autor::index'); //muestra el datatable con ciertos
$router->addPost('/autor','Autor::store'); //almacena por post un autor
$router->addGet('/autor/editar/:int','Autor::edit'); //vista de edicion para actualizar
$router->addPost('/autor/editar','Autor::update');//actualiza por post
$router->addPost('/autor/borrar/:int','Autor::delete');//borra el contenido

$router->notFound([
    'controller'=>'error',
    'action'=>'mostrar404'
    ]);
    
$router->addGet('/401','error::mostrar401');