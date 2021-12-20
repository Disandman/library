<?php

namespace App\models;

use App\config\DB_connect;

/**
 * Данный клас предназначен для поиска через сущность Нарушений пользователей некоторых элементов в базе (подразделений)
 */
class ConnectViolationModel
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }


    /**
     * Поиск одной записи (уникальный идентификатор передается через GET запрос) в базе по сущности "НАРУШЕНИЯ ПОЛЬЗОВАТЕЛЕЙ"
     * @return mixed
     */
    public function getOne()
    {
        $query = $this->entityManager->getRepository(':ConnectViolation')->createQueryBuilder('p');
        $query->where('p.id_user =' . $_GET['id']);
        return $query->getQuery()->getResult();
    }
}