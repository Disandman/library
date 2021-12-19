<?php

namespace App\models;

use App\config\DB_connect;

/**
 * Данный клас предназначен для поиска через сущность ReadersTicket некоторых элементов в базе (чит.билетов)
 */
class ReadersTicketModel
{
    const COURSE_1 = 1;
    const COURSE_2 = 2;
    const COURSE_3 = 3;
    const COURSE_4 = 4;
    const COURSE_5 = 5;
    const COURSE_6 = 6;
    const POSITION_ST = 1;
    const POSITION_EM = 2;

    /**
     * Список курсов
     * @var string[]
     */
    public static array $course = [
        self::COURSE_1 => '1 курс',
        self::COURSE_2 => '2 курс',
        self::COURSE_3 => '3 курс',
        self::COURSE_4 => '4 курс',
        self::COURSE_5 => '5 курс',
        self::COURSE_6 => '6 курс',
    ];

    /**
     * Должность
     * @var string[]
     */
    public static array $position = [
        self::POSITION_ST => 'Студент',
        self::POSITION_EM => 'Сотрудник',
    ];

    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Поиск всех записей в базе по сущности "Читательские билеты"
     * @return array|object[]
     */
    public function getAll()
    {
        $userRepository = $this->entityManager->getRepository(':ReadersTicket');
        return $userRepository->findAll();
    }

    /**
     * Поиск одной записи (уникальный идентификатор передается через GET запрос) в базе по сущности "Читательские билеты"
     * @return mixed|object|null
     */
    public function getOne()
    {
        $userRepository = $this->entityManager->getRepository(':ReadersTicket');
        return $userRepository->findOneBy(['id_user' => $_GET['id']]);
    }

    /**
     * Поиск не заблокированного читательского билета пользователя
     * @return int|mixed|string
     */
    public function getOneUser()
    {
        $query = $this->entityManager->getRepository(':ReadersTicket')->createQueryBuilder('p');
        $query->where('p.block = 0')
            ->andWhere('p.id_user =' . $_SESSION['id_user']);
        return $query->getQuery()->getResult();
    }

    /**
     * Используется для метода блокировки пользователя
     * @return mixed|object|null
     */
    public function getOneView()
    {
        $userRepository = $this->entityManager->getRepository(':ReadersTicket');
        return $userRepository->findOneBy(['id_readers_ticket' => $_GET['id']]);
    }

    /**
     * Используется для поиска читательского билета при действиях (выдать, списать) для сотрудника библиотеки и администратора
     * @param $id
     * @return mixed|object|null
     */
    public function getIdUser($id)
    {
        $userRepository = $this->entityManager->getRepository(':ReadersTicket');
        return $userRepository->findOneBy(['id_user' => $id]);
    }

    /**
     * Поиск заблокированного читателя
     * @return int|mixed|string
     */
    public function getUserBlock()
    {
        $query = $this->entityManager->getRepository(':ReadersTicket')->createQueryBuilder('p');
        $query->where('p.block = 1')
            ->andWhere('p.id_user =' . $_SESSION['id_user']);
        return $query->getQuery()->getResult();
    }

    /**
     * Используется для Имени владельца билета
     * @param $id
     * @return mixed|object|null
     */
    public function getUserName($id)
    {
        $userRepository = $this->entityManager->getRepository(':User');
        $user = $userRepository->findOneBy(['id_user' => $id]);
        return $user->getFullName();
    }

    /**
     * Используется для Подразделения владельца билета
     * @param $id
     * @return mixed|object|null
     */
    public function getUserDivision($id)
    {
        $userRepository = $this->entityManager->getRepository(':Division');
        $user = $userRepository->findOneBy(['id_division' => $id]);
        return $user->getDivision();
    }

    /**
     * Используется для поиска Курса владельца билета
     * @param $id
     * @return mixed|object|null
     */
    public function getUserCourse($id)
    {
        return self::$course[$id];
    }

    /**
     * Используется для поиска Группы владельца билета
     * @param $id
     * @return mixed|object|null
     */
    public function getUserGroup($id)
    {
        $userRepository = $this->entityManager->getRepository(':Group');
        $user = $userRepository->findOneBy(['id_group' => $id]);
        return $user->getGroupName();
    }

    /**
     * Используется для поиска Статуса владельца билета
     * @param $id
     * @return mixed|object|null
     */
    public function getUserStatus($id)
    {
        return UserModels::$status[$id];
    }
    /**
     * Используется для поиска Должности
     * @param $id
     * @return mixed|object|null
     */
    public function getPosition()
    {
        return self::$position;
    }
    /**
     * Используется для поиска Должности
     * @param $id
     * @return mixed|object|null
     */
    public function getPositionId($id)
    {
        return self::$position[$id];
    }
    /**
     * Используется для поиска Курса
     * @param $id
     * @return mixed|object|null
     */
    public function getCource()
    {
        return self::$course;
    }
    /**
     * Используется для поиска Статуса
     * @param $id
     * @return mixed|object|null
     */
    public function getStatus()
    {
        return UserModels::$status;
    }

    /**
     * Используется для поиска id владельца билета
     * @param $id
     * @return mixed|object|null
     */
    public function getUserId($id)
    {
        $userRepository = $this->entityManager->getRepository(':User');
        $user = $userRepository->findOneBy(['id_user' => $id]);
        return $user->getIdUser();
    }
}