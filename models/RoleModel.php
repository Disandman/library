<?php

namespace App\models;

class RoleModel
{
    public function getAll()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */
        $roleRepository = $entityManager->getRepository(':Role');
        $role = $roleRepository->findAll();
        return $role;
    }

    public function getOne()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */

        $id_role = $_GET['id'];
        $userRepository = $entityManager->getRepository(':Role');
        $user = $userRepository->findOneBy(['id_role' => $id_role]);
        return $user;
    }

}