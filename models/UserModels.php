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
    public function getAll(): array
    {
        if (!empty($_GET['full_name'])) {
            $full_name = $_GET['full_name'];
        } else $full_name = '';
        if (!empty($_GET['login'])) {
            $login = $_GET['login'];
        } else $login = '';

        $query = $this->entityManager->getRepository(':User')->createQueryBuilder('p');
        $query
            ->where('p.full_name LIKE :full_name')
            ->andWhere('p.login LIKE :login')
            ->setParameter('full_name', '%' . $full_name . '%')
            ->setParameter('login', '%' . $login . '%');

        if (!empty($_GET['role_user'])) {
            $query->andWhere('p.role= :role_user')
                ->setParameter('role_user', $_GET['role_user']);
        }
        if (!empty($_GET['active'])) {
            $query->andWhere('p.active= :active')
                ->setParameter('active', (boolean)$_GET['active']);
        }
        if (!empty($_GET['position'])) {
            $query
                ->Join(
                    'App\models\ReadersTicket',
                    'u',
                    'WITH',
                    'p.id_user = u.id_user'
                )
                ->andWhere('u.id_position= :position')
                ->setParameter('position', $_GET['position']);
        }
        return $query->getQuery()->getResult();
    }

    public function getAllDB()
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