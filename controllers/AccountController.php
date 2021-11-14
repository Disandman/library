<?php

namespace App\controllers;

use App\core\View;
use App\models\AcademicDegree;


class AccountController
{
    /**
     * @return void
     */
    public function login()
    {
        View::render('Главная страница','account/login.php');
    }

    /**
     * @return void
     */
    public function register()
    {
        View::render('Главная страница','account/register.php');
    }

    /**
     * @return void
     */
    public function logout()
    {
        View::render('Главная страница','account/index.php');
    }
    public function update(){

        require dirname(__DIR__) . '/config/bootstrap.php';


        $product = new AcademicDegree();
        $product->setName($_POST['name']);

        /** @var array $entityManager */
        $entityManager->persist($product);
        $entityManager->flush();
        View::redirect('/');



    }


}