<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Access;
use App\models\ConnectBooks;
use App\models\ConnectBooksModel;
use App\models\ConnectViolationModel;
use App\models\ReadersTicketModel;


/**
 *Контроллер управления книгами читателей
 */
class BooksUserController
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
     * Вывод книг читателя (авторизованному пользователю ч ролью читатель)
     * @throws \Exception
     */
    public function index()
    {
        $booksModel = new ConnectBooksModel();
        $readersTicketModel = new ReadersTicketModel();
        $connectViolation = new ConnectViolationModel();

        $resultMyBooks = $booksModel->getMyBooks();//книги выданные
        $resultBooksOrdered = $booksModel->getOrdered();//книги заказанные
        $resultLostBooks = $booksModel->getLost(); //пропавшие книги
        $readersTicket = $readersTicketModel->getUserBlock();//проверка на блокировку абонемента
        $resultConnectViolation = $connectViolation->getBlock();

        $model = [
            'myBook' => $resultMyBooks,
            'ordered' => $resultBooksOrdered,
            'lost' => $resultLostBooks,
            'access' => $this->access,
            'booksModel' => $booksModel,
            'resultConnectViolation' => $resultConnectViolation,
            'connectViolation' => $connectViolation
        ];

        if (!empty($readersTicket))//проверка (если абонемент заблокирован то выводить страницу блокировки если нет блокировки то выводить его книги)
            View::render('Мои книги', 'books-user/index.php', $model);
        else
            View::render('Мои книги', 'books-user/block.php', $model);
    }

    public function BlockAdmin()
    {
        $booksModel = new ConnectBooksModel();
        $connectViolation = new ConnectViolationModel();

        $resultLostBooks = $booksModel->getLost(); //пропавшие книги
        $resultConnectViolation = $connectViolation->getBlock();

        $model = [

            'lost' => $resultLostBooks,
            'booksModel' => $booksModel,
            'resultConnectViolation' => $resultConnectViolation,
            'connectViolation' => $connectViolation
        ];

            View::render('Мои книги', 'books-user/block.php', $model);
    }

//    /**
//     * Вывод всех книг (находятся у читателей либо утеряны но списаны)
//     * @throws \Exception
//     */
//    public function indexWorker()
//    {
//        $books = new ConnectBooksModel();
//
//        $resultBooks = $books->getWorker();//вывод книг читателя
//
//        $model = ['model' => $resultBooks,];
//
//        View::render('Просмотр книг', 'books-user/index.php', $model);
//    }

    /**
     * Добавление книги читателем
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add()
    {
        $book = new ConnectBooks();

        $classBooks = $this->entityManager->getRepository(':Books')->find($_GET['id']);//поиск книги пользователя (идентификатор приходит через GET)
        $book->setIdBooksConnect($classBooks);

        $book->setStatus(0);//присвоение статуса (книга добавлена в раздел заказанные)

        $classUser = $this->entityManager->getRepository(':User')->find($_SESSION['id_user']);//поиск пользователя (по идентификатору из сессии)
        $book->setIdUserConnect($classUser);

        $this->entityManager->persist($book);//добавление записи
        $this->entityManager->flush();//сохранение результата

        View::redirect('/books/index');
    }

    /**
     * Удаление книги пользователем (нажатие на кнопку отказаться)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function refusal()
    {

        $books = $this->entityManager->getRepository(ConnectBooks::class)->findOneBy(['id_connect_books' => $_GET['id']]);//поиск книги пользователя (идентификатор приходит через GET)

        $this->entityManager->remove($books);//удаление записи
        $this->entityManager->flush();//сохранение результата

        View::redirect('/books-user/index');
    }

    /**
     * Изменение статуса книги (нажатие на кнопку заявить о пропаже) (для пользователя)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function lost()
    {
        $books = $this->entityManager->getRepository(ConnectBooks::class)->findOneBy(['id_connect_books' => $_GET['id']]);//поиск книги пользователя (идентификатор приходит через GET)
        $books->setStatus(2);
        $books->setDateLost(date('Y-m-d'));//сохранение времени пропажи книги

        $this->entityManager->persist($books);
        $this->entityManager->flush();//сохранение

        View::redirect('/books-user/index');
    }

    /**
     * Выдача книги пользователю
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function issue()
    {
        $books = $this->entityManager->getRepository(ConnectBooks::class)->findOneBy(['id_connect_books' => $_GET['id']]);//поиск книги пользователя (идентификатор приходит через GET)
        $books->setDateTackingBooks(date('Y-m-d'));//время выдачи книги
        $books->setDateEndTackingBooks(date("Y-m-d", strtotime("+10 month")));//время на сколько выдается книга (в данном случае выдаю на 10 месяцев)
        $books->setStatus(1);//ставлю статус, что книга выдана пользователю (у пользователя будет отображаться что книга у него на руках)

        $this->entityManager->persist($books);
        $this->entityManager->flush();//сохранение результата

        View::redirect('/books-user/index?id=' . $books->getIdUser() . '');//редирект на страницу с книгами читателя
    }

    /**
     * Удаление книги из раздела "Потерянные" (книга снова будет доступна для добавления читателю)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function lostRefusal()
    {
        $books = $this->entityManager->getRepository(ConnectBooks::class)->findOneBy(['id_connect_books' => $_GET['id']]);//поиск книги пользователя (идентификатор приходит через GET)
        $books->setStatus(3);//изменение статуса на потеряно (решил что понадобятся записи для сбора статистики по потерянным книгам или если книги будут лимитированы)

        $this->entityManager->persist($books);
        $this->entityManager->flush();//сохранение результата

        View::redirect('/books-user/index?id=' . $books->getIdUser() . '');//редирект на страницу с книгами читателя

    }
}