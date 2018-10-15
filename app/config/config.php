<?php
include __DIR__ . '/../../vendor/autoload.php';

/**
 * Environment variables
 */
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../../');
$dotenv->load();

/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Postgresql',
        'host'        => 'ec2-54-225-110-152.compute-1.amazonaws.com',
        'username'    => 'lmbbsvewhapust',
        'password'    => '5655bf18d98184fb2873e90dea7d0cc5a417070dded5d3a3bd3f49a057f50fad',
        'dbname'      => 'dusvren3ai0nc',
        'schema' => 'public'
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => '/',
    ]
]);
