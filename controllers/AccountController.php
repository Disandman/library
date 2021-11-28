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
        $result = $user->getOne();
        $model = [
            'model' => $result,
        ];

        View::render('Главная страница','account/login.php', $model);
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

}