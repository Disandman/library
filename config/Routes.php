<?php

namespace App\config;

use App\core\Router;
use App\models\UserModels;

class Routes
{
    /**
     * Формирование рутинга на основе контроллеров и методов
     * @return Router
     * @throws \Exception
     */
    public static function Routes(): Router
    {
        $router = new Router();
        $emptyUserModel = new UserModels();
        $emptyUser = $emptyUserModel->getAll();

        if (empty($emptyUser))//проверка на существование хотя бы одной записи пользователя в базе (если нет то переход на страницу инициализации)
            $router->add('', ['controller' => 'HomeController', 'action' => 'indexInit']);
        else
            $router->add('', ['controller' => 'HomeController', 'action' => 'index']);

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

        $router->add('violation/index', ['controller' => 'ViolationController', 'action' => 'index']);
        $router->add('violation/update', ['controller' => 'ViolationController', 'action' => 'update']);
        $router->add('violation/create', ['controller' => 'ViolationController', 'action' => 'create']);
        $router->add('violation/delete', ['controller' => 'ViolationController', 'action' => 'delete']);

        $router->add('readers-ticket/index', ['controller' => 'ReadersTicketController', 'action' => 'index']);
        $router->add('readers-ticket/block', ['controller' => 'ReadersTicketController', 'action' => 'block']);

        $router->add('books-user/index', ['controller' => 'BooksUserController', 'action' => 'index']);
        $router->add('books-user/update', ['controller' => 'BooksUserController', 'action' => 'update']);
        $router->add('books-user/refusal', ['controller' => 'BooksUserController', 'action' => 'refusal']);
        $router->add('books-user/lost', ['controller' => 'BooksUserController', 'action' => 'lost']);
        $router->add('books-user/indexWorker', ['controller' => 'BooksUserController', 'action' => 'indexWorker']);
        $router->add('books-user/issue', ['controller' => 'BooksUserController', 'action' => 'issue']);
        $router->add('books-user/add', ['controller' => 'BooksUserController', 'action' => 'add']);
        $router->add('books-user/lostRefusal', ['controller' => 'BooksUserController', 'action' => 'lostRefusal']);
        $router->add('books-user/blockAdmin', ['controller' => 'BooksUserController', 'action' => 'blockAdmin']);

        $router->add('init/init', ['controller' => 'InitController', 'action' => 'init']);

        $router->add('{controller}/{action}');

        $router->dispatch($_SERVER['QUERY_STRING']);
        return $router;
    }
}