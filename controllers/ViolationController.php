<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Violation;
use App\models\ViolationModel;


/**
 * Контроллер управления Нарушениями пользователей
 */
class ViolationController
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Внесение в базу нового нарушения
     * @throws \Exception
     */
    public function index()
    {
        $violation = new ViolationModel();
        $resultViolation = $violation->getAll();

        $model = [
            'model' => $resultViolation
        ];

        View::render('Нарушения', 'violation/index.php', $model);
    }

    /**
     * Обновление существующей записи (роли) в базе
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function create()
    {
        if ($_POST) {

            $violation = new Violation();

            $violation->setNameViolations($_POST['name']);
            $violation->setPriceViolations($_POST['price']);

            $this->entityManager->persist($violation);
            $this->entityManager->flush();

            View::redirect('/violation/index');
        }
        View::render('Добавление нарушения', 'violation/create.php');
    }

    /**
     * Обновление существующей записи (нарушения) в базе
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function update()
    {
        $violationModel = new ViolationModel();
        $resultGroup = $violationModel->getOne();

        $model = [
            'model' => $resultGroup,
        ];
        if ($_POST) {

            $violation = $this->entityManager->getRepository(Violation::class)->findOneBy(['id_violation' => $_GET['id']]);

            $violation->setNameViolations($_POST['name']);
            $violation->setPriceViolations($_POST['price']);

            $this->entityManager->persist($violation);
            $this->entityManager->flush();

            View::redirect('/violation/index');
        }
        View::render('Изменение нарушения', 'violation/update.php', $model);
    }

    /**
     * Удаление записи (нарушения)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $violation = $this->entityManager->getRepository(Violation::class)->findOneBy(['id_violation' => $_GET['id']]);

        $this->entityManager->remove($violation);
        $this->entityManager->flush();

        View::redirect('/violation/index');
    }
}