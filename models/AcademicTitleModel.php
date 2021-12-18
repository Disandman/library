<?php

namespace App\models;


use App\config\DB_connect;

class AcademicTitleModel
{

    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $titleRepository = $entityManager->getRepository(':AcademicTitle');
        $title = $titleRepository->findAll();
        return $title;
    }
}