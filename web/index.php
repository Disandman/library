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
require dirname(__DIR__) . '/config/bootstrap.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('App\core\Error::errorHandler');
set_exception_handler('App\core\Error::exceptionHandler');

\App\config\Routes::Routes();
