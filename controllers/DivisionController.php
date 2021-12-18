<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Access;
use App\models\Division;
use App\models\DivisionModel;


/**
 * Контроллер управления подразделениями
 */
class DivisionController
{
    private $access; //проверка доступа на основе роли
    private $entityManager; //создание entityManager (Doctrine);

    function __construct()
    {
        $this->access = new Access();
        $entityManagerClass = new DB_connect();
        $this->entityManager = $entityManagerClass->connect();
    }

    /**
     * Вывод всех подразделений
     * @throws \Exception
     */
    public function index()
    {
        $division = new DivisionModel();
        $resultDivision = $division->getAll();

        $model = [
            'model' => $resultDivision
        ];

        View::render('Подразделения', 'division/index.php', $model);
    }

    /**
     * Внесение в базу нового подразделения
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create()
    {
        if ($_POST) {
            $division = new Division();
            $division->setDivision($_POST['division']);

            $this->entityManager->persist($division);
            $this->entityManager->flush();

            View::redirect('/division/index');
        }
        View::render('Добавление подразделения', 'division/create.php');
    }

    /**
     * Обновление существующей записи (подразделения) в базе
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {
        $divisionModel = new DivisionModel();
        $resultDivision = $divisionModel->getOne();
        $model = [
            'model' => $resultDivision,
        ];

        if ($_POST) {
            $division = $this->entityManager->getRepository(Division::class)->findOneBy(['id_division' => $_GET['id']]);

            $division->setDivision($_POST['division']);
            $this->entityManager->persist($division);
            $this->entityManager->flush();

            View::redirect('/division/index');
        }
        View::render('Главная страница', 'division/update.php', $model);
    }

    /**
     * Удаление записи (подразделения)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $division = $this->entityManager->getRepository(Division::class)->findOneBy(['id_division' => $_GET['id']]);//поиск нужной записи в базе (данные идентификаторе записи получаем через GET запрос)

        $this->entityManager->remove($division);
        $this->entityManager->flush();

        View::redirect('/division/index');
    }
}