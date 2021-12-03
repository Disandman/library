<?php

namespace App\controllers;

use App\core\View;
use App\models\UserModels;


class AccountController
{
    /**
     * @return void
     */
    public function indexLogin()
    {
        View::render('Главная страница', 'account/login.php');
    }


    /**
     * @return void
     */
    public function login()
    {
        if ($_POST['login'] !== '' && $_POST['password'] !== '') {
            $login = $_POST['login'];
            $password = (md5($_POST['password']));

            $user_model = new UserModels();
            $check_user = $user_model->getAuth($login, $password);

            if (isset($check_user)) {
                $_SESSION['id_user'] = $check_user->getIdUser();
                View::redirect('/');

            } else {
                $_SESSION['msg'] = 'Неправильный логин или пароль';
                View::redirect('/account/indexLogin');
            }

        } else {
            $_SESSION['msg'] = 'Введите логин и пароль';
            View::redirect('/account/indexLogin');
        }
    }

    /**
     * @return void
     */
    public function logout()
    {
        session_destroy();
        View::redirect('/');
        exit;
    }

}