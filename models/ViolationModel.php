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
    public function getAll(): array
    {
        if (!empty($_GET['name_violations'])){
            $name_violations = $_GET['name_violations'];}
        else $name_violations = '';
        if (!empty($_GET['price_violations'])){
            $price_violations = $_GET['price_violations'];}
        else $price_violations = '';
        $query = $this->entityManager->getRepository(':Violation')->createQueryBuilder('p');

        $query
            ->select('p')
            ->where('p.name_violations LIKE :name_violations')
            ->andWhere('p.price_violations LIKE :price_violations')
            ->setParameter('name_violations','%'.$name_violations.'%')
            ->setParameter('price_violations','%'.$price_violations.'%');

        return  $query->getQuery()->getResult();
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