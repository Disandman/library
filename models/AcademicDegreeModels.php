<?php

namespace App\models;


class AcademicDegreeModels
{

    public function getIndex()
    {


        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */
        $productRepository = $entityManager->getRepository(':AcademicDegree');
        $products = $productRepository->findAll();
        return $products;
    }

}