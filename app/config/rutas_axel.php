<?php
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