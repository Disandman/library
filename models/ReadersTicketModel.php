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
    public function getAll(): array
    {
        $query = $this->entityManager->getRepository(':ReadersTicket')->createQueryBuilder('p');
        if (!empty($_GET['date_blocking'])) {
            $query->andWhere('p.date_blocking= :date_blocking')
                ->setParameter('date_blocking', $_GET['date_blocking']);
        }
        if (!empty($_GET['date_unblocking'])) {
            $query->andWhere('p.date_unblocking= :date_unblocking')
                ->setParameter('date_unblocking', $_GET['date_unblocking']);
        }
        if (!empty($_GET['position'])) {
            $query->andWhere('p.id_position= :position')
                ->setParameter('position', $_GET['position']);
        }
        if (!empty($_GET['block'])) {
            $query->andWhere('p.block= :block')
                ->setParameter('block', $_GET['block']);
        }
        if (!empty($_GET['course'])) {
            $query->andWhere('p.id_course= :course')
                ->setParameter('course', $_GET['course']);
        }
        if (!empty($_GET['full_name'])) {
            $query
                ->Join(
                    'App\models\User',
                    'u',
                    'WITH',
                    'p.id_user= u.id_user'
                )
                ->andWhere('u.full_name LIKE :full_name')
                ->setParameter('full_name', '%'.$_GET['full_name'].'%');
        }
        if (!empty($_GET['division'])) {
            $query
                ->Join(
                    'App\models\Division',
                    'u',
                    'WITH',
                    'p.id_division= u.id_division'
                )
                ->andWhere('u.division LIKE :division')
                ->setParameter('division', '%'.$_GET['division'].'%');
        }
        if (!empty($_GET['group'])) {
            $query
                ->Join(
                    'App\models\Group',
                    'u',
                    'WITH',
                    'p.id_group= u.id_group'
                )
                ->andWhere('u.group_name LIKE :group')
                ->setParameter('group', '%'.$_GET['group'].'%');
        }

        return $query->getQuery()->getResult();
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