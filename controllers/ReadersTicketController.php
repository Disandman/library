<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\ConnectBooksModel;
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
        $booksModel = new ConnectBooksModel();
        $resultReadersTicket = $readersTicket->getAll();

        $model = [
            'model' => $resultReadersTicket,
            'readersTicket' => $readersTicket,
            'booksModel' => $booksModel
        ];

        View::render('Читатели', 'readers-ticket/index.php', $model);
    }


    /**
     * Блокировка читательского билета
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     * @var array $violationDatabase
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

        if ($_POST) {//если пришел POST
            $readersTicket = $this->entityManager->getRepository(ReadersTicket::class)->findOneBy(['id_readers_ticket' => $_GET['id']]);//поиск нужной записи в базе (данные идентификаторе записи получаем через GET запрос)
            if (!empty($resultConnectViolation)) {
                foreach ($resultConnectViolation as $resultConnectViolations) {//проверка для мультиселекта (выборка из базы значений по id_user)
                    $violationDatabase [] = $resultConnectViolations->getIdViolation();//создание массива с идентификаторами нарушений (из базы)
                }
                if (!empty($_POST['violation'])) {//если пользователь что-то выбрал

                    $violationToAdd = array_diff($_POST['violation'], $violationDatabase);//формируем массив (что нужно записать)
                    $violationToRemove = array_diff($violationDatabase, $_POST['violation']);//формируем массив (что нужно удалить)

                    foreach ($violationToAdd as $violationToAdds) {//записываем выбранные значения в базу
                        $saveViolation = new ConnectViolation();
                        $saveViolation->setIdConnectViolation($this->entityManager->getRepository(Violation::class)->findOneBy(['id_violation' => $violationToAdds]));
                        $saveViolation->setIdUser($this->entityManager->getRepository(User::class)->findOneBy(['id_user' => $_GET['id']]));
                        $this->entityManager->persist($saveViolation);
                    }
                    foreach ($violationToRemove as $violationToRemoves) {//удаляем значения (от которых отказался пользователь)
                        $saveViolation = $this->entityManager->getRepository(ConnectViolation::class)->findOneBy(['id_violation' => $violationToRemoves, 'id_user' => $_GET['id']]);
                        $this->entityManager->remove($saveViolation);
                    }
                } else {//если пользователь оставил поле пустым, но в базе имеются значения
                    for ($i = 0; $i < count($violationDatabase); $i++) {
                        $saveViolation = $this->entityManager->getRepository(ConnectViolation::class)->findOneBy(['id_user' => $_GET['id']]);
                        $this->entityManager->remove($saveViolation);
                        $this->entityManager->flush();//сохранение результата
                    }
                }
            } else {//если в базе нет значений, то создаем их
                if (!empty(($_POST['violation']))) {
                    foreach ($_POST['violation'] as $violations) {

                        $connectViolation = new ConnectViolation();
                        $connectViolation->setIdConnectViolation($this->entityManager->getRepository(Violation::class)->findOneBy(['id_violation' => $violations]));
                        $connectViolation->setIdUser($this->entityManager->getRepository(User::class)->findOneBy(['id_user' => $_GET['id']]));
                        $this->entityManager->persist($connectViolation);
                    }
                }
            }
            $readersTicket->setBlock($_POST['block']);//блокировка читательского билета
            if ($_POST['block'] == 0) {//если чекбокс в положении "заблокировать"
                $readersTicket->setDateBlocking(date('Y-m-d'));//текущее время
                $readersTicket->setDateUnblocking($_POST['date_unblocking']);//дата до какого чиста блокировать
            } else {//если разблокируют
                $readersTicket->setDateBlocking(null);//перезапись на null
                $readersTicket->setDateUnblocking(null);//перезапись на null
                for ($i = 0; $i < count($violationDatabase); $i++) {
                    $saveViolation = $this->entityManager->getRepository(ConnectViolation::class)->findOneBy(['id_user' => $_GET['id']]);
                    $this->entityManager->remove($saveViolation);
                    $this->entityManager->flush();//сохранение результата
                }
            }
            $this->entityManager->persist($readersTicket);
            $this->entityManager->flush();//сохранение результата

            View::redirect('/readers-ticket/index');
        }
        View::render('Блокировка читателя', 'readers-ticket/update.php', $model);
    }
}