<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Books;
use App\models\BooksModel;
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

    /**
     * @throws \Exception
     */
    public function view()
    {
        $books = new BooksModel();
        $resultBooks = $books->getOne();
        $model = ['model' => $resultBooks,];

        View::render('Главная страница', 'books/view.php', $model);
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

            $book = new Books();

            $book->setNameBooks($_POST['name']);
            $book->setAuthor($_POST['author']);
            $book->setPriceBooks($_POST['price']);
            $book->setDatePublication($_POST['date_publication']);
            $book->setDateReceipt($_POST['date_receipt']);
            $book->setDateLost($_POST['date_lost']);


            $entityManager->persist($book);
            $entityManager->flush();

            View::redirect('/books/index');

        }

        View::render('Главная страница', 'books/create.php');
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {

        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $booksModel = new BooksModel();
        $resultBooks = $booksModel->getOne();
        $model = [
            'model' => $resultBooks,
        ];

        if ($_POST) {
            $id_books = $_GET['id'];

            $book = $entityManager->getRepository(Books::class)->findOneBy(['id_books' => $id_books]);

            $book->setNameBooks($_POST['name']);
            $book->setAuthor($_POST['author']);
            $book->setPriceBooks($_POST['price']);
            $book->setDatePublication($_POST['date_publication']);
            $book->setDateReceipt($_POST['date_receipt']);
            $book->setDateLost($_POST['date_lost']);

            $entityManager->persist($book);
            $entityManager->flush();

            View::redirect('/books/index');

        }
        View::render('Главная страница', 'books/update.php', $model);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $books_id = $_GET['id'];

        $books = $entityManager->getRepository(Books::class)->findOneBy(['id_books' => $books_id]);
        $entityManager->remove($books);
        $entityManager->flush();
        View::redirect('/books/index');

    }

}