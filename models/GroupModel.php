<?php

namespace App\models;

use App\config\DB_connect;

/**
 * Данный клас предназначен для поиска через сущность GROUP некоторых элементов в базе (групп)
 */
class GroupModel
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Поиск всех записей в базе по сущности "Группы"
     * @return array
     */
    public function getAll(): array
    {
        if (!empty($_GET['group_name'])){
            $group_name = $_GET['group_name'];}
        else $group_name = '';
        $query = $this->entityManager->getRepository(':Group')->createQueryBuilder('p');
        $query
            ->select('p')
            ->where('p.group_name LIKE :group_name')
            ->setParameter('group_name','%'.$group_name.'%');

        return  $query->getQuery()->getResult();
    }

    /**
     * Поиск одной записи (уникальный идентификатор передается через GET запрос) в базе по сущности "ГРУППЫ"
     * @return mixed
     */
    public function getOne()
    {
        $groupRepository = $this->entityManager->getRepository(':Group');
        return $groupRepository->findOneBy(['id_group' => $_GET['id']]);
    }
}