<?php

namespace App\models;


class AcademicDegreeModels
{

    public function getIndex()
    {


        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */
        $degreeRepository = $entityManager->getRepository(':AcademicDegree');
        $degree = $degreeRepository->findAll();
        return $degree;
    }

}