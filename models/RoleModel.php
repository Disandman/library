<?php

namespace App\models;

use App\config\DB_connect;

class RoleModel
{
    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $roleRepository = $entityManager->getRepository(':Role');
        $role = $roleRepository->findAll();
        return $role;
    }

    /**
     * @return mixed|object|null
     */
    public function getOne()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $id_role = $_GET['id'];
        $userRepository = $entityManager->getRepository(':Role');
        $user = $userRepository->findOneBy(['id_role' => $id_role]);
        return $user;
    }

}