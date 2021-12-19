<?php

namespace App\models;

use App\config\DB_connect;


class ConnectAcadenicInfoModel
{
    /**
     * @return array|object[]
     */
    public function getAll()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $connect_books_model = $entityManager->getRepository(':ConnectAcademicInfo');
        $connect_books = $connect_books_model->findAll();
        return $connect_books;
    }

    /**
     * @return mixed|object|null
     */
    public function getOne()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        $id_user = $_GET['id'];
        $connect_books_model = $entityManager->getRepository(':ConnectAcademicInfo');
        $connect_books = $connect_books_model->findOneBy(['id_user' => $id_user]);
        return $connect_books;
    }

}