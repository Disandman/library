<?php

namespace App\models;

use App\config\DB_connect;

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

    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findAll();
        return $user;
    }

    /**
     * @return mixed|object|null
     */
    public function getOne()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $id_user = $_GET['id'];
        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findOneBy(['id_user' => $id_user]);
        return $user;
    }

    /**
     * @param $login
     * @param $password
     * @return mixed|object|null
     */
    public function getAuth($login, $password)
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findOneBy(['login' => $login, 'password' => $password]);
        return $user;
    }

    /**
     * @param $id
     * @return mixed|object|null
     */
    public function getIdUser($id)
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $userRepository = $entityManager->getRepository(':User');
        $user = $userRepository->findOneBy(['id_user' => $id]);
        return $user;
    }

}