<?php


$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(array(
    'App\Models' => BASE_PATH. '/app/models/',
    'App\Validations' => BASE_PATH. '/app/validaciones/',
    'App\Middlewares'=> BASE_PATH.'/app/middlewares/'


));
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();
