<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\ConnectBooks;
use App\models\ConnectBooksModel;
use App\models\ReadersTicketModel;


class BooksUserController
{

    protected $entityManagerClass;
    protected $entityManager;

    function __construct()
    {
        $this->entityManagerClass = new DB_connect();
        $this->entityManager = $this->entityManagerClass->connect();
    }

    /**
     * @throws \Exception
     */
    public function index()
    {
        $books = new ConnectBooksModel();
        $access = new \App\models\Access();

        $query = $this->entityManager->getRepository(':ReadersTicket')->createQueryBuilder('p');
        $query->where('p.block = 1')
            ->andWhere('p.id_user =' . $_SESSION['id_user']);
        $readersTicket = $query->getQuery()->getResult();


        $resultBooksOrdered = $books->getOrdered();
        $resultMyBooks = $books->getMyBooks();
        $resultLost = $books->getLost();

        $model = [
            'ordered' => $resultBooksOrdered,
            'myBook' => $resultMyBooks,
            'lost' => $resultLost,
            'access' => $access
        ];

        if (!empty($readersTicket))
            View::render('Мои книги', 'books-user/index.php', $model);
        else  View::render('Мои книги', 'books-user/block.php');
    }

    /**
     * @throws \Exception
     */
    public function indexWorker()
    {
        $books = new ConnectBooksModel();
        $resultBooks = $books->getWorker();

        $model = ['model' => $resultBooks,];

        View::render('Просмотр книг', 'books-user/index.php', $model);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add()
    {


        $book = new ConnectBooks();

        $id_books = $_GET['id'];
        $id_user = $_SESSION['id_user'];

        $classBooks = $this->entityManager->getRepository(':Books')->find($id_books);
        $book->setIdBooksConnect($classBooks);

        $book->setRefund(1);
        $book->setStatus(0);

        $classUser = $this->entityManager->getRepository(':User')->find($id_user);
        $book->setIdUserConnect($classUser);

        $this->entityManager->persist($book);
        $this->entityManager->flush();

        View::redirect('/books/index');

    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function refusal()
    {
        $id_connect_books = $_GET['id'];

        $books = $this->entityManager->getRepository(ConnectBooks::class)->findOneBy(['id_connect_books' => $id_connect_books]);
        $this->entityManager->remove($books);
        $this->entityManager->flush();
        View::redirect('/books-user/index');

    }

    public function lost()
    {

        $id_connect_books = $_GET['id'];

        $books = $this->entityManager->getRepository(ConnectBooks::class)->findOneBy(['id_connect_books' => $id_connect_books]);
        $books->setStatus(2);
        $books->setDateLost(date('Y-m-d'));
        $this->entityManager->persist($books);
        $this->entityManager->flush();
        View::redirect('/books-user/index');

    }

    public function issue()
    {
        $id_connect_books = $_GET['id'];

        $books = $this->entityManager->getRepository(ConnectBooks::class)->findOneBy(['id_connect_books' => $id_connect_books]);
        $books->setDateTackingBooks(date('Y-m-d'));
        $books->setDateEndTackingBooks(date("Y-m-d", strtotime("+2 month")));
        $books->setStatus(1);
        $this->entityManager->persist($books);
        $this->entityManager->flush();

        View::redirect('/books-user/index?id=' . $books->getIdUser() . '');
    }

    public function lostRefusal()
    {
        $id_connect_books = $_GET['id'];

        $books = $this->entityManager->getRepository(ConnectBooks::class)->findOneBy(['id_connect_books' => $id_connect_books]);
        $books->setStatus(3);
        $this->entityManager->persist($books);
        $this->entityManager->flush();
        View::redirect('/books-user/index?id=' . $books->getIdUser() . '');

    }

}