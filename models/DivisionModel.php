<?php

namespace App\models;

use App\config\DB_connect;

class DivisionModel
{
    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $divisionRepository = $entityManager->getRepository(':Division');
        $division = $divisionRepository->findAll();
        return $division;
    }

    /**
     * @return mixed|object|null
     */
    public function getOne()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $id_division = $_GET['id'];
        $divisionRepository = $entityManager->getRepository(':Division');
        $division = $divisionRepository->findOneBy(['id_division' => $id_division]);
        return $division;
    }

}