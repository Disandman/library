<?php

namespace App\models;

use App\config\DB_connect;

/**
 * Данный клас предназначен для поиска через сущность Division некоторых элементов в базе (подразделений)
 */
class DivisionModel
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Поиск всех записей в базе по сущности "КНИГИ"
     * @return array
     */
    public function getAll(): array
    {
        $divisionRepository = $this->entityManager->getRepository(':Division');
        return $divisionRepository->findAll();
    }

    /**
     * Поиск одной записи (уникальный идентификатор передается через GET запрос) в базе по сущности "ПОДРАЗДЕЛЕНИЯ"
     * @return mixed
     */
    public function getOne()
    {
        $divisionRepository = $this->entityManager->getRepository(':Division');
        return $divisionRepository->findOneBy(['id_division' => $_GET['id']]);
    }
}