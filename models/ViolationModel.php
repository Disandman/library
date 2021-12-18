<?php

namespace App\models;

use App\config\DB_connect;

class ViolationModel
{
    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $groupRepository = $entityManager->getRepository(':Violation');
        $group = $groupRepository->findAll();
        return $group;
    }

    /**
     * @return mixed|object|null
     */
    public function getOne()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $id_violation = $_GET['id'];
        $groupRepository = $entityManager->getRepository(':Violation');
        $group = $groupRepository->findOneBy(['id_violation' => $id_violation]);
        return $group;
    }

}