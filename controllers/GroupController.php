<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Group;
use App\models\GroupModel;


class GroupController
{

    /**
     * @throws \Exception
     */
    public function index()
    {
        $division = new GroupModel();
        $resultGroup = $division->getAll();
        $model = ['model' => $resultGroup,];

        View::render('Подразделения', 'group/index.php', $model);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        if ($_POST) {

            $group = new Group();

            $group->setGroupName($_POST['group']);

            $entityManager->persist($group);
            $entityManager->flush();

            View::redirect('/group/index');

        }

        View::render('Добавление группы', 'group/create.php');
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {

        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $groupModel = new GroupModel();
        $resultGroup = $groupModel->getOne();
        $model = [
            'model' => $resultGroup,
        ];

        if ($_POST) {
            $id_group = $_GET['id'];

            $group = $entityManager->getRepository(Group::class)->findOneBy(['id_group' => $id_group]);

            $group->setGroupName($_POST['group']);

            $entityManager->persist($group);
            $entityManager->flush();

            View::redirect('/group/index');

        }
        View::render('Изменение подразделения', 'group/update.php', $model);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $id_group = $_GET['id'];

        $group = $entityManager->getRepository(Group::class)->findOneBy(['id_group' => $id_group]);
        $entityManager->remove($group);
        $entityManager->flush();
        View::redirect('/group/index');

    }

}