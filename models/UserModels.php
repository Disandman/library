<?php

namespace App\models;

use Doctrine\ORM\EntityRepository;

class UserModels
{

    public function getIndex()
    {


        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */
        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findAll();
        return $user;
    }

}