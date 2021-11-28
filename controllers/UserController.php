<?php

namespace App\controllers;

use App\core\View;
use App\models\Role;
use App\models\RoleModel;
use App\models\User;
use App\models\UserModels;

class UserController
{
    /**
     * @return void
     */
    public function index()
    {

        $role = new RoleModel();
        $user = new UserModels();
        $resultUser = $user->getIndex();
        $resultRole = $role->getIndex();
        $model = [
            'model' => $resultUser,
            'role' => $resultRole
        ];
        View::render('Главная страница', 'user/index.php', $model);
    }
    public function view()
    {

        $role = new RoleModel();
        $user = new UserModels();
        $resultUser = $user->getView();
        $resultRole = $role->getIndex();
        $model = [
            'model' => $resultUser,
            'role' => $resultRole
        ];
        View::render('Главная страница', 'user/view.php', $model);
    }


    public function create()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';

        $roleModel = new RoleModel();
        $resultRole = $roleModel->getIndex();
        $role = [
            'role' => $resultRole,
        ];

        if ($_POST) {
            $user = new User();

            $user->setLogin($_POST['login']);
            $user->setPassword(md5($_POST['password']));
            $user->setFullName($_POST['full_name']);
            $user->setActive($_POST['status']);
            $user->setRole($_POST['role']);

            /** @var array $entityManager */
            $classRole = $entityManager->getRepository(':Role')->find($_POST['role']);
            $user->setRole($classRole);
            $entityManager->persist($user);
            $entityManager->flush();
            View::redirect('/user/index');

        }
        View::render('Главная страница', 'user/create.php', $role);
    }

    public function update()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';

        $roleModel = new RoleModel();
        $resultRole = $roleModel->getIndex();


        $view = new UserModels();
        $viewModel = $view->getUpdate();

        $model = [
            'role' => $resultRole,
            'model' =>$viewModel,
        ];

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
            $classRole = $entityManager->getRepository(':Role')->find($_POST['role']);
            $user->setRole($classRole);
            $entityManager->persist($user);
            $entityManager->flush();
            View::redirect('/user/index');

        }

        View::render('Главная страница', 'user/update.php', $model);
    }

    public function delete()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';

        /** @var array $entityManager */

        $id_user = $_GET['id'];

        $user = $entityManager->getRepository(User::class)->findOneBy(['id_user' => $id_user]);
        $entityManager->remove($user);
        $entityManager->flush();
        View::redirect('/user/index');

    }

}