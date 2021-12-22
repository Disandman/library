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
     * Поиск всех записей в базе по сущности "ПОДРАЗДЕЛЕНИЯ"
     * @return array
     */
    public function getAll(): array
    {
        if (!empty($_GET['division'])){
            $division = $_GET['division'];}
        else $division = '';
        $query = $this->entityManager->getRepository(':Division')->createQueryBuilder('p');

        $query
            ->select('p')
            ->where('p.division LIKE :division')
            ->setParameter('division','%'.$division.'%');

        return  $query->getQuery()->getResult();
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