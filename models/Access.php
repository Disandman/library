<?php

namespace App\models;

use App\config\DB_connect;
use Exception;

/**
 * Проверка доступа на основе роли пользователя
 */
class Access
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }
    /**
     * @param $role
     * @return bool
     * @throws Exception
     */
    public function getRole($role)
    {
        if (!empty($_SESSION['id_user'])) {

            $user = new UserModels();
            $user_model = $user->getIdUser($_SESSION['id_user']);

            $user_role = $this->entityManager->getRepository(':Role')->find($user_model->getRole())->getName();
            return $user_role == $role ?  true : false;
        }
    }
}