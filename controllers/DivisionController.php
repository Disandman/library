<?php

namespace App\controllers;

use App\config\DB_connect;
use App\core\View;
use App\models\Books;
use App\models\BooksModel;
use App\models\Division;
use App\models\DivisionModel;


class DivisionController
{

    /**
     * @throws \Exception
     */
    public function index()
    {
        $division = new DivisionModel();
        $resultDivision = $division->getAll();
        $model = ['model' => $resultDivision,];

        View::render('Подразделения', 'division/index.php', $model);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create()
    {
        $entityManagerClass = new DB_connect();
        $entityManager = $entityManagerClass->connect();

        if ($_POST) {

            $division = new Division();

            $division->setDivision($_POST['division']);

            $entityManager->persist($division);
            $entityManager->flush();

            View::redirect('/division/index');

        }

        View::render('Добавление подразделения', 'division/create.php');
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {

        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $divisionModel = new DivisionModel();
        $resultDivision = $divisionModel->getOne();
        $model = [
            'model' => $resultDivision,
        ];

        if ($_POST) {
            $id_division = $_GET['id'];

            $division = $entityManager->getRepository(Division::class)->findOneBy(['id_division' => $id_division]);

            $division->setDivision($_POST['division']);

            $entityManager->persist($division);
            $entityManager->flush();

            View::redirect('/division/index');

        }
        View::render('Главная страница', 'division/update.php', $model);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete()
    {
        $entityManagerConnect = new DB_connect();
        $entityManager = $entityManagerConnect->connect();

        $id_division = $_GET['id'];

        $division = $entityManager->getRepository(Division::class)->findOneBy(['id_division' => $id_division]);
        $entityManager->remove($division);
        $entityManager->flush();
        View::redirect('/division/index');

    }

}