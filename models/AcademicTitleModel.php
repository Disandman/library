<?php

namespace App\models;


use App\config\DB_connect;

/**
 * Данный клас предназначен для поиска через сущность AcademicTitle некоторых элементов в базе (Ученых степеней)
 */
class AcademicTitleModel
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Вывод всех научных степеней
     * @return array|object[]
     */
    public function getAll()
    {
        $titleRepository = $this->entityManager->getRepository(':AcademicTitle');
        return $titleRepository->findAll();
    }
}