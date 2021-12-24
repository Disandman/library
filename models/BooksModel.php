<?php

namespace App\models;

use App\config\DB_connect;
use App\core\Paginator;

/**
 * Данный клас предназначен для поиска через сущность Books некоторых элементов в базе (книг)
 */
class BooksModel
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Поиск всех записей в базе по сущности "КНИГИ"
     * @return array|object[]
     */
//    public function getAll(): array
//    {
//        $booksRepository = $this->entityManager->getRepository(':Books');
//        return $booksRepository->findAll();
//    }
    /**
     * Поиск всех записей в базе по сущности "КНИГИ"
     * @return array|object[]
     */
    public function getAll(): array
    {
        if (!empty($_GET['name'])) {
            $name = $_GET['name'];
        } else $name = '';
        if (!empty($_GET['author'])) {
            $author = $_GET['author'];
        } else $author = '';
        if (!empty($_GET['date_publication'])) {
            $date_publication = $_GET['date_publication'];
        } else $date_publication = '';
        $query = $this->entityManager->getRepository(':Books')->createQueryBuilder('p');

        $query
            ->select('p')
            ->where('p.name_books LIKE :name')
            ->andWhere('p.author LIKE :author')
            ->andWhere('p.date_publication LIKE :date_publication')
            ->setParameter('name', '%' . $name . '%')
            ->setParameter('author', '%' . $author . '%')
            ->setParameter('date_publication', '%' . $date_publication . '%');

        $paginator = new Paginator();
        $maxResult = 10;
        $resultPaginator = $paginator->getModelResultPage(count($query->getQuery()->getResult()),$maxResult);
        $firstResult = $resultPaginator;

        $query->setFirstResult($firstResult)
            ->setMaxResults($maxResult);

        return $query->getQuery()->getResult();
    }

    /**
     * Поиск одной записи (уникальный идентификатор передается через GET запрос) в базе по сущности "КНИГИ"
     * @return mixed|object|null
     */
    public function getOne()
    {
        $userRepository = $this->entityManager->getRepository(':Books');
        return $userRepository->findOneBy(['id_books' => $_GET['id']]);
    }
}
