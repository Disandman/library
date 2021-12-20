<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Role;
use App\models\RoleModel;

/**
 * Контроллер управления Ролями пользователей
 */
class RoleController
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Внесение в базу новой роли
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function create()
    {
        if ($_POST) {
            $user = new Role();

            $user->setName($_POST['role']);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            View::redirect('/user/index');
        }
        View::render('Создание роли пользователя', 'role/create.php');
    }

    /**
     * Обновление существующей записи (роли) в базе
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function update()
    {
        $roleModel = new RoleModel();

        $resultRole = $roleModel->getOne();
        $model = [
            'model' => $resultRole,
        ];
        if ($_POST) {
            $role = $this->entityManager->getRepository(Role::class)->findOneBy(['id_role' => $_GET['id']]);//поиск нужной записи в базе (данные идентификаторе записи получаем через GET запрос)
            $role->setName($_POST['role']);

            $this->entityManager->persist($role);
            $this->entityManager->flush();

            View::redirect('/user/index');
        }
        View::render('Изменение роли', 'role/update.php', $model);
    }

    /**
     * Удаление записи (роли)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $role = $this->entityManager->getRepository(Role::class)->findOneBy(['id_role' => $_GET['id']]);//поиск нужной записи в базе (данные идентификаторе записи получаем через GET запрос)

        $this->entityManager->remove($role);
        $this->entityManager->flush();

        View::redirect('/user/index');
    }
}