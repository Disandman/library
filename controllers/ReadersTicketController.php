<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Books;
use App\models\BooksModel;
use App\models\ReadersTicket;
use App\models\ReadersTicketModel;


class ReadersTicketController
{

    /**
     * @throws \Exception
     */
    public function index()
    {
        $readersTicket = new ReadersTicketModel();
        $resultReadersTicket = $readersTicket->getAll();
        $model = ['model' => $resultReadersTicket,];

        View::render('Главная страница', 'readers-ticket/index.php', $model);
    }


    public function update()
    {

        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $readersTicketModel = new ReadersTicketModel();
        $resultReadersTicket = $readersTicketModel->getOneView();
        $model = [
            'model' => $resultReadersTicket,
        ];

        if ($_POST) {
            $id_readers_ticket = $_GET['id'];

            $readersTicket = $entityManager->getRepository(ReadersTicket::class)->findOneBy(['id_readers_ticket' => $id_readers_ticket]);


            $readersTicket->setBlock($_POST['block']);
            $readersTicket->setDateBlocking($_POST['date_blocking']);
            $readersTicket->setDateUnblocking($_POST['date_unblocking']);

            $entityManager->persist($readersTicket);
            $entityManager->flush();

            View::redirect('/readers-ticket/index');

        }
        View::render('Главная страница', 'readers-ticket/update.php', $model);
    }

}