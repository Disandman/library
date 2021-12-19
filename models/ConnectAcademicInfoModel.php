<?php

namespace App\models;

use App\config\DB_connect;


/**
 * Данный клас предназначен для поиска через сущность ConnectAcademicInfo некоторых элементов в базе (научных званий и степеней)
 */
class ConnectAcademicInfoModel
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Поиск записей о научных званиях и степенях сотрудников
     * @return array
     */
    public function getAll(): array
    {
        $connect_books_model = $this->entityManager->getRepository(':ConnectAcademicInfo');
        return $connect_books_model->findAll();
    }


    /**
     * Поиск одной записи (уникальный идентификатор передается через GET запрос)
     * @return mixed
     */
    public function getOne()
    {
        $connect_books_model = $this->entityManager->getRepository(':ConnectAcademicInfo');
        return $connect_books_model->findOneBy(['id_user' => $_GET['id']]);
    }

    /**
     * Используется для поиска научной степени владельца билета
     * @param $id
     * @return mixed|object|null
     */
    public function getAcademicTitle($id)
    {
        $userRepository = $this->entityManager->getRepository(':AcademicTitle');
        $user = $userRepository->findOneBy(['id_academic_title' => $id]);
        return $user->getName();
    }

    /**
     * Используется для поиска научного звания владельца билета
     * @param $id
     * @return mixed|object|null
     */
    public function getAcademicDegree($id)
    {
        $userRepository = $this->entityManager->getRepository(':AcademicDegree');
        $user = $userRepository->findOneBy(['id_academic_degree' => $id]);
        return $user->getName();
    }
}