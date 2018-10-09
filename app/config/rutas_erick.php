<?php

$router->addGet('/autor','Autor::index');
$router->addPost('/autor','Autor::store');
$router->addGet('/autor/editar/:int','Autor::edit');
$router->addPost('/autor/editar','Autor::update');
$router->addPost('/autor/borrar/:int','Autor::delete');

