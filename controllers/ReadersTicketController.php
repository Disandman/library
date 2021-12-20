<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\ConnectViolation;
use App\models\ConnectViolationModel;
use App\models\ReadersTicket;
use App\models\ReadersTicketModel;
use App\models\User;
use App\models\Violation;
use App\models\ViolationModel;


/**
 * Контроллер управления Читательскими билетами
 */
class ReadersTicketController
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Вывод читательских билетов
     * @throws \Exception
     */
    public function index()
    {
        $readersTicket = new ReadersTicketModel();
        $resultReadersTicket = $readersTicket->getAll();

        $model = [
            'model' => $resultReadersTicket,
            'readersTicket' => $readersTicket
        ];

        View::render('Читатели', 'readers-ticket/index.php', $model);
    }


    /**
     * Блокировка читательского билета
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function block()
    {
        $readersTicketModel = new ReadersTicketModel();
        $violationModel = new ViolationModel();
        $connectViolationModel = new ConnectViolationModel();

        $resultReadersTicket = $readersTicketModel->getOneView();
        $resultViolation = $violationModel->getAll();
        $resultConnectViolation = $connectViolationModel->getOne();

        $model = [
            'model' => $resultReadersTicket,
            'readersTicketModel' => $readersTicketModel,
            'violationModel' => $resultViolation,
            'resultConnectViolation' => $resultConnectViolation

        ];

        if ($_POST) {
            $readersTicket = $this->entityManager->getRepository(ReadersTicket::class)->findOneBy(['id_readers_ticket' => $_GET['id']]);//поиск нужной записи в базе (данные идентификаторе записи получаем через GET запрос)
            if (!empty($resultConnectViolation)) {

                foreach ($resultConnectViolation as $resultConnectViolations){
                   $violationDatabase []= $resultConnectViolations->getIdViolation();
                }

                $violationIntersect = array_intersect($violationDatabase, $_POST['violation']);
                $violationDiff = array_diff($violationDatabase, $_POST['violation']);

                foreach ($violationIntersect as $violationIntersects) {
                    $saveViolation = new ConnectViolation();
                    $saveViolation->setIdConnectViolation($this->entityManager->getRepository(Violation::class)->findOneBy(['id_violation' => $violationIntersects]));
                    $saveViolation->setIdUser($this->entityManager->getRepository(User::class)->findOneBy(['id_user' => $_GET['id']]));

                    $this->entityManager->persist($saveViolation);
                    $this->entityManager->flush();//сохранение результата
                }
                foreach ($violationDiff as $violationDiffs) {
                    $saveViolation =$this->entityManager->getRepository(ConnectViolation::class)->findOneBy(['id_violation' => $violationDiffs, 'id_user' => $_GET['id']]);

                    $this->entityManager->remove($saveViolation);
                    $this->entityManager->flush();//сохранение результата
                }

            } else {

            foreach ($_POST['violation'] as $violations) {

                $connectViolation = new ConnectViolation();
                $connectViolation->setIdConnectViolation($this->entityManager->getRepository(Violation::class)->findOneBy(['id_violation' => $violations]));
                $connectViolation->setIdUser($this->entityManager->getRepository(User::class)->findOneBy(['id_user' => $_GET['id']]));

                $this->entityManager->persist($connectViolation);
                $this->entityManager->flush();//сохранение результата
            }
            }

            $readersTicket->setBlock($_POST['block']);//блокировка читательского билета
            if ($_POST['block'] == 0) {//если чекбокс в положении "заблокировать"
                $readersTicket->setDateBlocking(date('Y-m-d'));//текущее время
                $readersTicket->setDateUnblocking($_POST['date_unblocking']);//дата до какого чиста блокировать


            } else {
                $readersTicket->setDateBlocking(null);//перезапись на null
                $readersTicket->setDateUnblocking(null);//перезапись на null
            }
            $this->entityManager->persist($readersTicket);
            $this->entityManager->flush();//сохранение результата

            View::redirect('/readers-ticket/index');
        }
        View::render('Блокировка читателя', 'readers-ticket/update.php', $model);
    }
}