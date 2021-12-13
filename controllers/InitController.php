<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\AcademicDegree;
use App\models\AcademicTitle;
use App\models\Role;
use App\models\RoleModel;
use App\models\User;
use App\models\UserModels;
use Exception;
use App\models\Access;

class InitController
{
    private function academicDegree()
    {
        return [
            'д.арх.н.', 'к.арх.н.',
            'д.б.н.', 'к.б.н.',
            'д.в.н.', 'к.в.н.',
            'д.воен.н.', 'к.воен.н.',
            'д.г.н.', 'к.г.н.',
            'д.г.-м.н.', 'к.г.-м.н.',
            'д.иск.', 'к.иск.',
            'д.и.н.', 'к.и.н.',
            'д.м.н.', 'к.м.н.',
            'д.п.н.', 'к.п.н.',
            'д.пол.н', 'к.пол.н',
            'д.псх.н.', 'к.псх.н.',
            'д.с.-х.н.', 'к.с.-х.н.',
            'д.соц.н.', 'к.соц.н.',
            'д.т.н.', 'к.т.н.',
            'д.фарм.н.', 'к.фарм.н.',
            'д.ф.-м.н.', 'к.ф.-м.н.',
            'д.филол.н.', 'к.филол.н.',
            'д.филос.н.', 'к.филос.н.',
            'д.х.н.', 'к.х.н.',
            'д.э.н.', 'к.э.н.',
            'д.ю.н.', 'к.ю.н.'
        ];
    }

    private function academicTitle()
    {
        return [
            'доц.', 'проф.',
            'с.н.с.', 'б/с',
        ];
    }


    public function init()
    {
        $user = new User();
        $role = new Role();


        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();


        foreach ($this->academicDegree() as $academicDegreeSave) {
            $academicDegree = new AcademicDegree();
            $academicDegree->setName($academicDegreeSave);
            $entityManager->persist($academicDegree);
            $entityManager->flush();
        }


        foreach ($this->academicTitle() as $academicTitleSave) {
            $academicTitle = new AcademicTitle();
            $academicTitle->setName($academicTitleSave);
            $entityManager->persist($academicTitle);
            $entityManager->flush();
        }

        $role->setName('Администратор');

        $entityManager->persist($role);
        $entityManager->flush();

        $roleId = $role->getIdRole();

        $user->setLogin('admin');
        $user->setPassword(md5('admin'));
        $user->setFullName('Администратор системы');
        $user->setActive(1);

        $classRole = $entityManager->getRepository(':Role')->find($roleId);
        $user->setRole($classRole);

        $entityManager->persist($user);
        $entityManager->flush();

        $_SESSION['msg'] = 'Логин: admin<br>Пароль: admin';
        View::redirect('/account/indexLogin');
    }

}