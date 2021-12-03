<?php

namespace App\controllers;

use App\core\View;
use App\models\RoleModel;
use App\models\User;
use App\models\UserModels;
use Exception;
use App\models\Access;

class UserController
{
    /**
     * @return void
     * @throws Exception
     */
    public function index()
    {

        $role = new RoleModel();
        $user = new UserModels();
        $access = new Access();

        $resultUser = $user->getAll();
        $resultRole = $role->getAll();

        $model = [
            'model' => $resultUser,
            'role' => $resultRole
        ];

        if ($access->getRole('Администратор')) {

            View::render('Главная страница', 'user/index.php', $model);
        } else {
            View::render('Ошибка доступа', '/layouts/error_403.php');
        }
    }

    /**
     * @throws Exception
     */
    public function view()
    {

        $role = new RoleModel();
        $user = new UserModels();
        $access = new Access();

        $resultUser = $user->getOne();
        $resultRole = $role->getAll();

        $model = [
            'model' => $resultUser,
            'role' => $resultRole
        ];
        if ($access->getRole('Администратор')) {
            View::render('Главная страница', 'user/view.php', $model);

        } else {
            View::render('Ошибка доступа', '/layouts/error_403.php');
        }
    }


    /**
     * @throws Exception
     */
    public function create()
    {

        $roleModel = new RoleModel();
        $access = new Access();

        $resultRole = $roleModel->getAll();
        $role = [
            'role' => $resultRole,
        ];
        if ($access->getRole('Администратор')) {
            if ($_POST) {
                $user = new User();

                $user->setLogin($_POST['login']);
                $user->setPassword(md5($_POST['password']));
                $user->setFullName($_POST['full_name']);
                $user->setActive($_POST['status']);
                $user->setRole($_POST['role']);

                /** @var array $entityManager */
                $classRole = $entityManager->getRepository(':Role')->find($_POST['role'][0]);
                $user->setRole($classRole);
                $entityManager->persist($user);
                $entityManager->flush();
                View::redirect('/user/index');

            }
            View::render('Главная страница', 'user/create.php', $role);
        } else {
            View::render('Ошибка доступа', '/layouts/error_403.php');
        }
    }

    /**
     * @throws Exception
     */
    public function update()
    {

        $roleModel = new RoleModel();
        $access = new Access();
        $view = new UserModels();

        $resultRole = $roleModel->getAll();
        $viewModel = $view->getOne();

        $model = [
            'role' => $resultRole,
            'model' => $viewModel,
        ];
        if ($access->getRole('Администратор')) {
            if ($_POST) {
                $id_user = $_GET['id'];

                /** @var object $entityManager */
                $user = $entityManager->getRepository(User::class)->findOneBy(['id_user' => $id_user]);

                $user->setLogin($_POST['login']);
                $user->setPassword(md5($_POST['password']));
                $user->setFullName($_POST['full_name']);
                $user->setActive($_POST['status']);
                $user->setRole($_POST['role']);

                /** @var array $entityManager */
                $classRole = $entityManager->getRepository(':Role')->find($_POST['role'][0]);
                $user->setRole($classRole);
                $entityManager->persist($user);
                $entityManager->flush();
                View::redirect('/user/index');
            }
            View::render('Главная страница', 'user/update.php', $model);
        } else {
            View::render('Ошибка доступа', '/layouts/error_403.php');
        }
    }

    public function delete()
    {

        /** @var array $entityManager */

        $access = new Access();
        $id_user = $_GET['id'];

        if ($access->getRole('Администратор')) {
            $user = $entityManager->getRepository(User::class)->findOneBy(['id_user' => $id_user]);
            $entityManager->remove($user);
            $entityManager->flush();
            View::redirect('/user/index');
        } else {
            View::render('Ошибка доступа', '/layouts/error_403.php');
        }
    }
}