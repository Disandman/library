<?php

namespace App\models;

use App\config\DB_connect;

class BooksModel
{
    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $booksRepository = $entityManager->getRepository(':Books');
        $books = $booksRepository->findAll();
        return $books;
    }

    /**
     * @return mixed|object|null
     */
    public function getOne()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $id_books = $_GET['id'];
        $userRepository = $entityManager->getRepository(':Books');
        $books = $userRepository->findOneBy(['id_books' => $id_books]);
        return $books;
    }

}