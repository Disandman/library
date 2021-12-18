<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Group;
use App\models\GroupModel;
use App\models\Violation;
use App\models\ViolationModel;


class ViolationController
{

    /**
     * @throws \Exception
     */
    public function index()
    {
        $violation = new ViolationModel();
        $resultViolation = $violation->getAll();
        $model = ['model' => $resultViolation,];

        View::render('Нарушения', 'violation/index.php', $model);
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

            $violation = new Violation();

            $violation->setNameViolations($_POST['name']);
            $violation->setPriceViolations($_POST['price']);

            $entityManager->persist($violation);
            $entityManager->flush();

            View::redirect('/violation/index');

        }

        View::render('Добавление нарушения', 'violation/create.php');
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {

        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $violationModel = new ViolationModel();
        $resultGroup = $violationModel->getOne();
        $model = [
            'model' => $resultGroup,
        ];

        if ($_POST) {
            $id_violation = $_GET['id'];

            $violation = $entityManager->getRepository(Violation::class)->findOneBy(['id_violation' => $id_violation]);

            $violation->setNameViolations($_POST['name']);
            $violation->setPriceViolations($_POST['price']);

            $entityManager->persist($violation);
            $entityManager->flush();

            View::redirect('/violation/index');

        }
        View::render('Изменение нарушения', 'violation/update.php', $model);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $id_violation = $_GET['id'];

        $violation = $entityManager->getRepository(Violation::class)->findOneBy(['id_violation' => $id_violation]);
        $entityManager->remove($violation);
        $entityManager->flush();
        View::redirect('/violation/index');

    }

}