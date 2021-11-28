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
        $router->add('account/logout', ['controller' => 'AccountController', 'action' => 'logout']);
        $router->add('user/index', ['controller' => 'UserController', 'action' => 'index']);
        $router->add('user/view', ['controller' => 'UserController', 'action' => 'view']);
        $router->add('user/create', ['controller' => 'UserController', 'action' => 'create']);
        $router->add('user/update', ['controller' => 'UserController', 'action' => 'update']);
        $router->add('user/delete', ['controller' => 'UserController', 'action' => 'delete']);
        $router->add('role/update', ['controller' => 'RoleController', 'action' => 'update']);
        $router->add('role/create', ['controller' => 'RoleController', 'action' => 'create']);
        $router->add('role/delete', ['controller' => 'RoleController', 'action' => 'delete']);
        $router->add('{controller}/{action}');

        $router->dispatch($_SERVER['QUERY_STRING']);
        return $router;
    }

}