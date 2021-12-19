<?php

namespace App\models;

use App\config\DB_connect;

/**
 * Данный клас предназначен для поиска через сущность Violation некоторых элементов в базе (нарушений)
 */
class ViolationModel
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Поиск всех записей в базе по сущности "Нарушения"
     * @return array|object[]
     */
    public function getAll()
    {
        $groupRepository = $this->entityManager->getRepository(':Violation');
        return $groupRepository->findAll();
    }

    /**
     * Поиск одной записи (уникальный идентификатор передается через GET запрос) в базе по сущности "Нарушения"
     * @return mixed|object|null
     */
    public function getOne()
    {
        $groupRepository = $this->entityManager->getRepository(':Violation');
        return $groupRepository->findOneBy(['id_violation' => $_GET['id']]);
    }
}