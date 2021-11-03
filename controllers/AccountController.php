<?php

namespace App\controllers;

use App\core\View;

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

}