<?php

namespace App\models;


use App\config\DB_connect;

class AcademicDegreeModel
{

    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $degreeRepository = $entityManager->getRepository(':AcademicDegree');
        $degree = $degreeRepository->findAll();
        return $degree;
    }

}