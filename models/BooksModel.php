<?php

namespace App\models;

use App\config\DB_connect;

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
    public function getAll(): array
    {
        $booksRepository = $this->entityManager->getRepository(':Books');
        return $booksRepository->findAll();
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