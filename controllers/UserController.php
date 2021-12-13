<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\DivisionModel;
use App\models\GroupModel;
use App\models\ReadersTicket;
use App\models\ReadersTicketModel;
use App\models\Role;
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
        $readersTicket = new ReadersTicketModel();
        $access = new Access();

        $resultUser = $user->getOne();
        $resultRole = $role->getAll();
        $resultReadersTicket = $readersTicket->getOne();


        $model = [
            'model' => $resultUser,
            'role' => $resultRole,
            'readersTicket' => $resultReadersTicket
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
        $readersTicketModel = new ReadersTicketModel();
        $divisionModel = new DivisionModel();
        $groupModel = new GroupModel();

        $access = new Access();

        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $resultRole = $roleModel->getAll();
        $resultReadersTicket = $readersTicketModel->getAll();
        $resultDivision = $divisionModel->getAll();
        $resultGroup = $groupModel->getAll();

        $model = [
            'role' => $resultRole,
            'readersTicket' => $resultReadersTicket,
            'division' => $resultDivision,
            'group' => $resultGroup
        ];
        if ($access->getRole('Администратор')) {
            if ($_POST) {
                $user = new User();
                $readersTicket = new ReadersTicket();

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

                $classUser = $entityManager->getRepository(':User')->find($user->getIdUser());
                $readersTicket->setUserConnect($classUser);

                $classDivision = $entityManager->getRepository(':Division')->find($_POST['division']);
                $readersTicket->setIdDivisionConnect($classDivision);

                $readersTicket->setIdCourse($_POST['course']);

                $classGroup = $entityManager->getRepository(':Group')->find($_POST['group']);
                $readersTicket->setIdGroupConnect($classGroup);
                $readersTicket->setBlock(1);

                $entityManager->persist($readersTicket);
                $entityManager->flush();

                View::redirect('/user/index');
            }
            View::render('Добавление пользователя', 'user/create.php', $model);
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
        $readersTicketModel = new ReadersTicketModel();
        $divisionModel = new DivisionModel();
        $groupModel = new GroupModel();

        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $resultRole = $roleModel->getAll();
        $viewModel = $view->getOne();
        $resultReadersTicket = $readersTicketModel->getAll();
        $resultDivision = $divisionModel->getAll();
        $resultGroup = $groupModel->getAll();

        $model = [
            'role' => $resultRole,
            'model' => $viewModel,
            'readersTicket' => $resultReadersTicket,
            'division' => $resultDivision,
            'group' => $resultGroup
        ];
        if ($access->getRole('Администратор')) {
            if ($_POST) {
                $id_user = $_GET['id'];

                /** @var object $entityManager */
                $user = $entityManager->getRepository(User::class)->findOneBy(['id_user' => $id_user]);
                $readersTicket = $entityManager->getRepository(ReadersTicket::class)->findOneBy(['id_user' => $id_user]);

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

                $classUser = $entityManager->getRepository(':User')->find($user->getIdUser());
                $readersTicket->setUserConnect($classUser);

                $classDivision = $entityManager->getRepository(':Division')->find($_POST['division']);
                $readersTicket->setIdDivisionConnect($classDivision);

                $readersTicket->setIdCourse($_POST['course']);

                $classGroup = $entityManager->getRepository(':Group')->find($_POST['group']);
                $readersTicket->setIdGroupConnect($classGroup);
                $readersTicket->setBlock(1);

                $entityManager->persist($readersTicket);
                $entityManager->flush();

                View::redirect('/user/index');
            }
            View::render('Главная страница', 'user/update.php', $model);
        } else {
            View::render('Ошибка доступа', '/layouts/error_403.php');
        }
    }


    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {

        $access = new Access();
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

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