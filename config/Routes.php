<?php

namespace App\config;

class Routes
{
    public static function Routes()
    {
        $emtyUserModel = new \App\models\UserModels();
        $emtyUser = $emtyUserModel->getAll();

        /**
         * Routing
         */
        $router = new \App\core\Router();

        if (empty($emtyUser)) {
        $router->add('', ['controller' => 'HomeController', 'action' => 'indexInit']);
        }else{
            $router->add('', ['controller' => 'HomeController', 'action' => 'index']);
        }
        $router->add('account/indexLogin', ['controller' => 'AccountController', 'action' => 'indexLogin']);
        $router->add('account/login', ['controller' => 'AccountController', 'action' => 'login']);
        $router->add('account/logout', ['controller' => 'AccountController', 'action' => 'logout']);

        $router->add('user/index', ['controller' => 'UserController', 'action' => 'index']);
        $router->add('user/view', ['controller' => 'UserController', 'action' => 'view']);
        $router->add('user/create', ['controller' => 'UserController', 'action' => 'create']);
        $router->add('user/update', ['controller' => 'UserController', 'action' => 'update']);
        $router->add('user/delete', ['controller' => 'UserController', 'action' => 'delete']);
        $router->add('user/oneUser', ['controller' => 'UserController', 'action' => 'oneUser']);

        $router->add('role/update', ['controller' => 'RoleController', 'action' => 'update']);
        $router->add('role/create', ['controller' => 'RoleController', 'action' => 'create']);
        $router->add('role/delete', ['controller' => 'RoleController', 'action' => 'delete']);

        $router->add('books/index', ['controller' => 'BooksController', 'action' => 'index']);
        $router->add('books/view', ['controller' => 'BooksController', 'action' => 'view']);
        $router->add('books/update', ['controller' => 'BooksController', 'action' => 'update']);
        $router->add('books/create', ['controller' => 'BooksController', 'action' => 'create']);
        $router->add('books/delete', ['controller' => 'BooksController', 'action' => 'delete']);

        $router->add('division/index', ['controller' => 'DivisionController', 'action' => 'index']);
        $router->add('division/update', ['controller' => 'DivisionController', 'action' => 'update']);
        $router->add('division/create', ['controller' => 'DivisionController', 'action' => 'create']);
        $router->add('division/delete', ['controller' => 'DivisionController', 'action' => 'delete']);

        $router->add('group/index', ['controller' => 'GroupController', 'action' => 'index']);
        $router->add('group/update', ['controller' => 'GroupController', 'action' => 'update']);
        $router->add('group/create', ['controller' => 'GroupController', 'action' => 'create']);
        $router->add('group/delete', ['controller' => 'GroupController', 'action' => 'delete']);

        $router->add('readers-ticket/index', ['controller' => 'ReadersTicketController', 'action' => 'index']);

        $router->add('init/init', ['controller' => 'InitController', 'action' => 'init']);

        $router->add('{controller}/{action}');

        $router->dispatch($_SERVER['QUERY_STRING']);
        return $router;
    }

}