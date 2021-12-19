<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Access;
use App\models\Books;
use App\models\BooksModel;
use App\models\ConnectBooksModel;
use App\models\ReadersTicketModel;

/**
 *Контроллер управления книгами
 */
class BooksController
{
    private $access; //проверка доступа на основе роли
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $this->access = new Access();
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Вывод всех книгами
     * @throws \Exception
     */
    public function index()
    {
        $booksModel = new BooksModel();
        $connectBooksModel = new ConnectBooksModel();
        $readersTicketModel = new ReadersTicketModel();

        $resultBooks = $booksModel->getAll();

        $model = [
            'model' => $resultBooks,
            'access' => $this->access,
            'connectBooks' => $connectBooksModel,
            'readersTicket' => $readersTicketModel
        ];

        View::render('Книги', 'books/index.php', $model);
    }

    /**
     * Просмотр каждой книги (подробное описание)
     * @throws \Exception
     */
    public function view()
    {
        $books = new BooksModel();

        $resultBooks = $books->getOne();

        $model = [
            'model' => $resultBooks,
            'access' => $this->access
        ];
        View::render('Просмотр книги', 'books/view.php', $model);
    }

    /**
     * Внесение в базу новой книги
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create()
    {
        if ($_POST) {
            $book = new Books();

            $book->setNameBooks($_POST['name']);
            $book->setAuthor($_POST['author']);
            $book->setDescription($_POST['description']);
            $book->setPriceBooks($_POST['price']);
            $book->setDatePublication($_POST['date_publication']);
            $book->setDateReceipt($_POST['date_receipt']);

            $this->entityManager->persist($book);
            $this->entityManager->flush();//запись в базу

            View::redirect('/books/index');

        }
        View::render('Добавление книги', 'books/create.php');
    }

    /**
     * Обновление существующей записи (книги) в базе
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {
        $booksModel = new BooksModel();

        $resultBooks = $booksModel->getOne();

        $model = [
            'model' => $resultBooks,
        ];

        if ($_POST) {
            $book = $this->entityManager->getRepository(Books::class)->findOneBy(['id_books' => $_GET['id']]);

            $book->setNameBooks($_POST['name']);
            $book->setAuthor($_POST['author']);
            $book->setDescription($_POST['description']);
            $book->setPriceBooks($_POST['price']);
            $book->setDatePublication($_POST['date_publication']);
            $book->setDateReceipt($_POST['date_receipt']);

            $this->entityManager->persist($book);
            $this->entityManager->flush();//запись в базу

            View::redirect('/books/index');
        }
        View::render('Изменение книги', 'books/update.php', $model);
    }

    /**
     * Удаление записи (книги)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $books = $this->entityManager->getRepository(Books::class)->findOneBy(['id_books' => $_GET['id']]);//поиск нужной записи в базе (данные идентификаторе записи получаем через GET запрос)
        $this->entityManager->remove($books);//удаление
        $this->entityManager->flush();//сохранение

        View::redirect('/books/index');
    }
}