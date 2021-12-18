<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\AcademicDegree;
use App\models\AcademicTitle;
use App\models\ReadersTicket;
use App\models\Role;
use App\models\User;

/**
 * Контроллер инициализации приложения
 */
class InitController
{
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Массив с научными степенями
     * @return string[]
     */
    private function academicDegree(): array
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

    /**
     * Массив с научными званиями
     * @return string[]
     */
    private function academicTitle(): array
    {
        return [
            'доц.', 'проф.',
            'с.н.с.', 'б/с',
        ];
    }

    /**
     * Массив с ролями пользователя
     * @return string[]
     */
    private function role(): array
    {
        return [
            'Администратор',
            'Сотрудник библиотеки',
            'Читатель'
        ];
    }


    /**
     * Наполнение базы данных (пользователем, ролями, научными степенями, званиями, создание читательского билета пользователю)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function init()
    {
        $user = new User();
        $readersTicket = new ReadersTicket();

        foreach ($this->academicDegree() as $academicDegreeSave) {//наполнение базы научными степенями
            $academicDegree = new AcademicDegree();
            $academicDegree->setName($academicDegreeSave);

            $this->entityManager->persist($academicDegree);
            $this->entityManager->flush();
        }

        foreach ($this->academicTitle() as $academicTitleSave) {//наполнение базы научными званиями
            $academicTitle = new AcademicTitle();
            $academicTitle->setName($academicTitleSave);

            $this->entityManager->persist($academicTitle);
            $this->entityManager->flush();
        }

        foreach ($this->role() as $roles) {//наполнение базы ролями пользователей
            $role = new Role();
            $role->setName($roles);

            $this->entityManager->persist($role);
            $this->entityManager->flush();
        }
///////////////////////Создание пользователя/////////////////////////
        $user->setLogin('admin');
        $user->setPassword(md5('admin'));
        $user->setFullName('Администратор системы');
        $user->setActive(1);
        $classRole = $this->entityManager->getRepository(':Role')->find(1);
        $user->setRole($classRole);

        $this->entityManager->persist($user);
        $this->entityManager->flush();//сохранение результатов

///////////////////////Создание читательского билета/////////////////
        $classIdUser = $this->entityManager->getRepository(':User')->find($user->getIdUser());

        $readersTicket->setUserConnect($classIdUser);
        $readersTicket->setBlock(1);
        $readersTicket->setIdPosition(2);

        $this->entityManager->persist($readersTicket);
        $this->entityManager->flush();

        $_SESSION['msg'] = 'Логин: admin<br>Пароль: admin';//вывод сообщения на страницу авторизации (сообщение уничтожится)

        View::redirect('/account/indexLogin');
    }
}