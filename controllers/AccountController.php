<?php

namespace App\controllers;

use App\core\View;
use App\models\AcademicDegree;
use App\models\UserModels;


class AccountController
{
    /**
     * @return void
     */
    public function login()
    {

        $user = new UserModels();
        $result = $user->getIndex();
        $model = [
            'model' => $result,
        ];

        View::render('Главная страница','account/login.php', $model);
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
        session_start();
        session_destroy();
        View::redirect('/');
        exit;
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