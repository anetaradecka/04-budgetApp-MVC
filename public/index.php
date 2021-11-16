<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

 // 864000 seconds = 10 days
ini_set('session.cookie_lifetime', '864000');

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Sessions
 */
session_start();

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('Home', ['controller' => 'Home', 'action' => 'index']);
$router->add('Balance', ['controller' => 'Balance', 'action' => 'index']);
$router->add('SignIn', ['controller' => 'SignIn', 'action' => 'new']);
$router->add('SignOut', ['controller' => 'SignIn', 'action' => 'destroy']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
