<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Role;
use App\models\RoleModel;

class RoleController
{

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $roleModel = new RoleModel();
        $resultRole = $roleModel->getAll();
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

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {

        $roleModel = new RoleModel();
        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $resultRole = $roleModel->getOne();
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

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $role_id = $_GET['id'];

        $role = $entityManager->getRepository(Role::class)->findOneBy(['id_role' => $role_id]);
        $entityManager->remove($role);
        $entityManager->flush();
        View::redirect('/user/index');

    }

}