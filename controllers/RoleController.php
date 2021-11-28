<?php

namespace App\controllers;

use App\core\View;
use App\models\Role;
use App\models\RoleModel;

class RoleController
{

    public function create()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';

        $roleModel = new RoleModel();
        $resultRole = $roleModel->getIndex();
        $role = [
            'role' => $resultRole,
        ];

        if ($_POST) {
            $user = new Role();

            $user->setName($_POST['role']);
            /** @var array $entityManager */
            $entityManager->persist($user);
            $entityManager->flush();

            View::redirect('/user/index');

        }

        View::render('Главная страница', 'role/create.php', $role);
    }

    public function update()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';

        $roleModel = new RoleModel();
        $resultRole = $roleModel->getUpdate();
        $model = [
            'model' => $resultRole,
        ];

        if ($_POST) {
            $id_role = $_GET['id'];

            /** @var object $entityManager */
            $role = $entityManager->getRepository(Role::class)->findOneBy(['id_role' => $id_role]);

            $role->setName($_POST['role']);
            /** @var array $entityManager */
            $entityManager->persist($role);
            $entityManager->flush();

            View::redirect('/user/index');

        }

        View::render('Главная страница', 'role/update.php', $model);
    }

    public function delete()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';

        /** @var array $entityManager */
        $role_id = $_GET['id'];

        $role = $entityManager->getRepository(Role::class)->findOneBy(['id_role' => $role_id]);
        $entityManager->remove($role);
        $entityManager->flush();
        View::redirect('/user/index');

    }

}