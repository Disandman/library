<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('App\core\Error::errorHandler');
set_exception_handler('App\core\Error::exceptionHandler');

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__. '/../');
$dotenv->load();

\App\config\Routes::Routes();
