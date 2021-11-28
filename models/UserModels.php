<?php

namespace App\models;

use Doctrine\ORM\EntityRepository;

class UserModels
{

    const STATUS_OFF = 0;
    const STATUS_ON = 1;

    /**
     * @var string[]
     */
    public static $status = [
        self::STATUS_ON => 'Активен',
        self::STATUS_OFF => 'Заблокирован',
    ];

    public function getIndex()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */
        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findAll();
        return $user;
    }
    public function getUpdate()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */

        $id_user = $_GET['id'];
        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findOneBy(['id_user' => $id_user]);
        return $user;
    }

}