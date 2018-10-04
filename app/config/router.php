<?php

$router = $di->getRouter();
/* routing login */

$router->addGet('/','Index::index');

$router->addPost('/','Index::login');

$router->addGet('/prueba','Prueba::index')->setName('prueba');

$router->handle();
