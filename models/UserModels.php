<?php

namespace App\models;

use App\config\DB_connect;

/**
 * Данный клас предназначен для поиска через сущность User некоторых элементов в базе (пользователей)
 */
class UserModels
{

    const STATUS_OFF = 0;
    const STATUS_ON = 1;

    /**
     * Статус (используется как при блокировке пользователя, так и для блокировки читательского билета)
     * @var string[]
     */
    public static $status = [
        self::STATUS_ON => 'Активен',
        self::STATUS_OFF => 'Заблокирован',
    ];

    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Поиск всех записей в базе по сущности "Пользователи"
     * @return array|object[]
     */
    public function getAll()
    {
        $userRepository = $this->entityManager->getRepository(':User');
        return $userRepository->findAll();
    }

    /**
     * Поиск одной записи (уникальный идентификатор передается через GET запрос) в базе по сущности "Пользователи"
     * @return mixed|object|null
     */
    public function getOne()
    {
        $userRepository = $this->entityManager->getRepository(':User');
        return $userRepository->findOneBy(['id_user' => $_GET['id']]);
    }

    /**
     * Служит для проверки на существование логина и пароля в базе
     * @param $login
     * @param $password
     * @return mixed|object|null
     */
    public function getAuth($login, $password)
    {
        $userRepository = $this->entityManager->getRepository(':User');
        return $userRepository->findOneBy(['login' => $login, 'password' => $password]);
    }

    /**
     * @param $id
     * @return mixed|object|null
     */
    public function getIdUser($id)
    {
        $userRepository = $this->entityManager->getRepository(':User');
        return $userRepository->findOneBy(['id_user' => $id]);
    }
    /**
     * Используется в навбаре для определения пользователя
     * @return mixed|object|void|null
     */
    public function getUser()
    {
        if (!empty($_SESSION['id_user'])) {
            $user = new UserModels();
            return $user->getIdUser($_SESSION['id_user']);
        }
    }

    /**
     * Используется для поиска id владельца билета
     * @param $id
     * @return mixed|object|null
     */
    public function getUserRole($id)
    {
        $userRepository = $this->entityManager->getRepository(':Role');
        $user = $userRepository->findOneBy(['id_role' => $id]);
        return $user->getName();
    }
}