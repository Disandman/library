<?php

namespace App\models;

class RoleModel
{
    public function getIndex()
    {
        require dirname(__DIR__) . '/config/bootstrap.php';
        /** @var array $entityManager */
        $roleRepository = $entityManager->getRepository(':Role');
        $role = $roleRepository->findAll();
        return $role;
    }

}