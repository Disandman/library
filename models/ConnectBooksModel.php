<?php

namespace App\models;

use App\config\DB_connect;
use Doctrine\ORM\Mapping as ORM;


class ConnectBooksModel
{
    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $connect_books_model = $entityManager->getRepository(':ConnectBooks');
        $connect_books = $connect_books_model->findAll();
        return $connect_books;
    }

    /**
     * @return array|object[]
     */
    public function getOrdered()
    {
        $modelUser = new \App\models\Access();
        $access = $modelUser->getUser();


        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $query = $entityManager->getRepository(':ConnectBooks')->createQueryBuilder('p');

        if (!$access->getRole('Администратор') || !$access->getRole('Сотрудник библиотеки')) {
            $query->where('p.status = 0')
                ->andWhere('p.id_user =' . $_SESSION['id_user']);
            return $query->getQuery()->getResult();
        } else {

            if (!empty($_GET['id'])) {
                $id_user = $_GET['id'];
            } else {
                $id_user = $_SESSION['id_user'];
            }
            $query->where('p.status = 0')
                ->andWhere('p.id_user =' . $id_user);
            return $query->getQuery()->getResult();
        }
    }

    /**
     * @return array|object[]
     */
    public function getMyBooks()
    {
        $modelUser = new \App\models\Access();
        $access = $modelUser->getUser();

        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $query = $entityManager->getRepository(':ConnectBooks')->createQueryBuilder('p');
        if (!$access->getRole('Администратор') || !$access->getRole('Сотрудник библиотеки')) {
            $query->where('p.status = 1')
                ->andWhere('p.id_user =' . $_SESSION['id_user']);
            return $query->getQuery()->getResult();
        } else {

            if (!empty($_GET['id'])) {
                $id_user = $_GET['id'];
            } else {
                $id_user = $_SESSION['id_user'];
            }

            $query->where('p.status = 1')
                ->andWhere('p.id_user =' . $id_user);
            return $query->getQuery()->getResult();
        }
    }

    /**
     * @return array|object[]
     */
    public function getLost()
    {
        $modelUser = new \App\models\Access();
        $access = $modelUser->getUser();

        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $query = $entityManager->getRepository(':ConnectBooks')->createQueryBuilder('p');
        if (!$access->getRole('Администратор') || !$access->getRole('Сотрудник библиотеки')) {
            $query->where('p.status = 2')
                ->andWhere('p.id_user =' . $_SESSION['id_user']);
            return $query->getQuery()->getResult();
        } else {

            if (!empty($_GET['id'])) {
                $id_user = $_GET['id'];
            } else {
                $id_user = $_SESSION['id_user'];
            }
            $query->where('p.status = 2')
                ->andWhere('p.id_user =' . $id_user);
            return $query->getQuery()->getResult();
        }
    }


    /**
     * @return array|object[]
     */
    public function getWorker()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $id_user = $_GET['id'];

        $query = $entityManager->getRepository(':ConnectBooks')->createQueryBuilder('p');
        $query->where('p.id_user = ' . $id_user);

        return $query->getQuery()->getResult();
    }

    public function getAvailability($books)
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $query = $entityManager->getRepository(':ConnectBooks')->createQueryBuilder('p');
        $query->where('p.id_user = ' . $_SESSION['id_user'])->andWhere('p.id_books = ' . $books)->andWhere('p.status = 0 OR p.status = 1 OR p.status = 2');

        return $query->getQuery()->getResult();
    }

    /**
     * @return mixed|object|null
     */
    public function getOne()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $id_user = $_GET['id'];
        $connect_books_model = $entityManager->getRepository(':ReadersTicket');
        $connect_books = $connect_books_model->findOneBy(['id_user' => $id_user]);
        return $connect_books;
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
}