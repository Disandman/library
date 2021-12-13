<?php

namespace App\models;

use App\config\DB_connect;

class GroupModel
{
    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $groupRepository = $entityManager->getRepository(':Group');
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

        $id_group = $_GET['id'];
        $groupRepository = $entityManager->getRepository(':Group');
        $group = $groupRepository->findOneBy(['id_group' => $id_group]);
        return $group;
    }

}