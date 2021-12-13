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
}