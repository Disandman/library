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

    public function getAll()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */
        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findAll();
        return $user;
    }
    public function getOne()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */

        $id_user = $_GET['id'];
        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findOneBy(['id_user' => $id_user]);
        return $user;
    }

    public function getAuth($login,$password)
    {
        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */

        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findOneBy(['login' => $login, 'password' => $password]);
        return $user;
    }

    public function getIdUser($id)
    {
        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */

        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findOneBy(['id_user' => $id]);
        return $user;
    }

}