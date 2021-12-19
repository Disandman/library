<?php

namespace App\models;

use App\config\DB_connect;

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
    public function getAll()
    {
        $roleRepository = $this->entityManager->getRepository(':Role');
        return $roleRepository->findAll();
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