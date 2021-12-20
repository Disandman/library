<?php

namespace App\models;

use App\config\DB_connect;

/**
 * Данный клас предназначен для поиска через сущность AcademicDegree некоторых элементов в базе (Ученых званий)
 */
class AcademicDegreeModel
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }
    /**
     * Вывод всех научных званий
     * @return array|object[]
     */
    public function getAll()
    {
        $degreeRepository = $this->entityManager->getRepository(':AcademicDegree');
        return $degreeRepository->findAll();
    }
}