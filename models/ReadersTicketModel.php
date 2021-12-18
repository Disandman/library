<?php

namespace App\models;

use App\config\DB_connect;
use Doctrine\ORM\Mapping as ORM;


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
     * @var string[]
     */
    public static $course = [
        self::COURSE_1 => '1 курс',
        self::COURSE_2=> '2 курс',
        self::COURSE_3 => '3 курс',
        self::COURSE_4 => '4 курс',
        self::COURSE_5 => '5 курс',
        self::COURSE_6 => '6 курс',
    ];

    /**
     * @var string[]
     */
    public static $position = [
        self::POSITION_ST => 'Студент',
        self::POSITION_EM=> 'Сотрудник',
    ];


    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $userRepository = $entityManager->getRepository(':ReadersTicket');
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
        $userRepository = $entityManager->getRepository(':ReadersTicket');
        $user = $userRepository->findOneBy(['id_user' => $id_user]);

        return $user;
    }

    public function getOneUser()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $query = $entityManager->getRepository(':ReadersTicket')->createQueryBuilder('p');
        $query->where('p.block = 0')
            ->andWhere('p.id_user =' . $_SESSION['id_user']);
        $user = $query->getQuery()->getResult();

        return $user;
    }

    public function getOneView()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $id_readers_ticket = $_GET['id'];
        $userRepository = $entityManager->getRepository(':ReadersTicket');
        $user = $userRepository->findOneBy(['id_readers_ticket' => $id_readers_ticket]);
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

        $userRepository = $entityManager->getRepository(':ReadersTicket');
        $user = $userRepository->findOneBy(['id_user' => $id]);
        return $user;
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

}