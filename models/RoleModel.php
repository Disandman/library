<?php

namespace App\models;

use App\config\DB_connect;
use App\core\Paginator;

/**
 * Данный клас предназначен для поиска через сущность Role некоторых элементов в базе (ролей)
 */
class RoleModel
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Поиск всех записей в базе по сущности "РОЛИ"
     * @return array|object[]
     */
    public function getAll(): array
    {
        if (!empty($_GET['role'])) {
            $role = $_GET['role'];
        } else $role = '';

        $query = $this->entityManager->getRepository(':Role')->createQueryBuilder('p');

        $query
            ->select('p')
            ->where('p.name LIKE :role')
            ->setParameter('role', '%' . $role . '%');
        $paginator = new Paginator();
        $maxResult = 10;
        $resultPaginator = $paginator->getModelResultPage(count($query->getQuery()->getResult()), $maxResult);
        $firstResult = $resultPaginator;

        $query->setFirstResult($firstResult)
            ->setMaxResults($maxResult);

        return $query->getQuery()->getResult();
    }

    /**
     * Поиск одной записи (уникальный идентификатор передается через GET запрос) в базе по сущности "РОЛИ"
     * @return mixed|object|null
     */
    public function getOne()
    {
        $userRepository = $this->entityManager->getRepository(':Role');
        return $userRepository->findOneBy(['id_role' => $_GET['id']]);
    }

    /**
     * Используется для поиска id владельца билета
     * @param $id
     * @return mixed|object|null
     */
    public function getUserRoleId($id)
    {
        $userRepository = $this->entityManager->getRepository(':Role');
        $user = $userRepository->find($id);
        return $user->getIdRole();
    }
}