<?php

namespace App\models;

use App\config\DB_connect;
use Exception;

class Access
{

    /**
     * @param $role
     * @return bool
     * @throws Exception
     */
    public function getRole($role)
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();
        if (!empty($_SESSION['id_user'])) {

            $user = new UserModels();
            $id = $_SESSION['id_user'];
            $user_model = $user->getIdUser($id);

            /** @var object $entityManager */
            $user_role = $entityManager->getRepository(':Role')->find($user_model->getRole())->getName();
            if ($user_role == $role)
                return true;
        }
    }

    /**
     * @return mixed|object|void|null
     */
    public function getUser()
    {
        if (!empty($_SESSION['id_user'])) {

            $user = new UserModels();
            $id = $_SESSION['id_user'];
            return $user->getIdUser($id);
        }
    }
}