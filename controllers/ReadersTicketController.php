<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\ReadersTicket;
use App\models\ReadersTicketModel;


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
            'model' => $resultReadersTicket
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
        $resultReadersTicket = $readersTicketModel->getOneView();

        $model = [
            'model' => $resultReadersTicket,
        ];

        if ($_POST) {
            $readersTicket = $this->entityManager->getRepository(ReadersTicket::class)->findOneBy(['id_readers_ticket' => $_GET['id']]);//поиск нужной записи в базе (данные идентификаторе записи получаем через GET запрос)

            $readersTicket->setBlock($_POST['block']);//блокировка читательского билета
            if ($_POST['block'] == 0) {//если чекбокс в положении "заблокировать"
                $readersTicket->setDateBlocking(date('Y-m-d'));//текущее время
                $readersTicket->setDateUnblocking($_POST['date_unblocking']);//дата до какого чиста блокировать
            }
            else {
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