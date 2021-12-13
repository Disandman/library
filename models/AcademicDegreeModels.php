<?php

namespace App\models;


use App\config\DB_connect;

class AcademicDegreeModels
{

    /**
     * @return array|object[]
     */
    public function getIndex()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $degreeRepository = $entityManager->getRepository(':AcademicDegree');
        $degree = $degreeRepository->findAll();
        return $degree;
    }

}