<?php

namespace App\config;

class Routes
{
    public static function Routes(){
        /**
         * Routing
         */
        $router = new \App\core\Router();

// Add the routes
        $router->add('', ['controller' => 'HomeController', 'action' => 'index']);
        $router->add('account/login', ['controller' => 'AccountController', 'action' => 'login']);
        $router->add('account/register', ['controller' => 'AccountController', 'action' => 'register']);
        $router->add('account/update', ['controller' => 'AccountController', 'action' => 'update']);
        $router->add('user/index', ['controller' => 'UserController', 'action' => 'index']);
        $router->add('user/create', ['controller' => 'UserController', 'action' => 'create']);
        $router->add('user/delete', ['controller' => 'UserController', 'action' => 'delete']);
        $router->add('{controller}/{action}');

        $router->dispatch($_SERVER['QUERY_STRING']);
        return $router;
    }

}