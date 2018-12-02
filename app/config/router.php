<?php

$router = $di->getRouter(false);




  
// se integraran despues para egit vitar conflictos

require_once('rutas_erick.php'); 
require_once('rutas_vero.php');
require_once('rutas_paty.php');
require_once('rutas_christian.php');
require_once('rutas_axel.php');


$router->handle();
