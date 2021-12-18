<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Group;
use App\models\GroupModel;


/**
 * Контроллер управления Группами
 */
class GroupController
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Вывод всех групп
     * @throws \Exception
     */
    public function index()
    {
        $group = new GroupModel();
        $resultGroup = $group->getAll();

        $model = [
            'model' => $resultGroup
        ];

        View::render('Группы', 'group/index.php', $model);
    }

    /**
     * Внесение в базу новой группы
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create()
    {
        if ($_POST) {

            $group = new Group();
            $group->setGroupName($_POST['group']);

            $this->entityManager->persist($group);
            $this->entityManager->flush();

            View::redirect('/group/index');

        }

        View::render('Добавление группы', 'group/create.php');
    }

    /**
     * Обновление существующей записи (группы) в базе
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {
        $groupModel = new GroupModel();
        $resultGroup = $groupModel->getOne();
        $model = [
            'model' => $resultGroup,
        ];
        if ($_POST) {
            $group = $this->entityManager->getRepository(Group::class)->findOneBy(['id_group' => $_GET['id']]);

            $group->setGroupName($_POST['group']);
            $this->entityManager->persist($group);
            $this->entityManager->flush();

            View::redirect('/group/index');
        }
        View::render('Изменение подразделения', 'group/update.php', $model);
    }

    /**
     * Удаление записи (группы)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $group = $this->entityManager->getRepository(Group::class)->findOneBy(['id_group' => $_GET['id']]);//поиск нужной записи в базе (данные идентификаторе записи получаем через GET запрос)

        $this->entityManager->remove($group);
        $this->entityManager->flush();

        View::redirect('/group/index');
    }
}