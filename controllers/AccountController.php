<?php

namespace App\controllers;

use App\core\View;
use App\models\UserModels;


/**
Контроллер используется для авторизации пользователей
 */
class AccountController
{
    /**
     * Вывод формы авторизации
     * @return void
     */
    public function indexLogin()
    {
        View::render('Авторизация', 'account/login.php');
    }


    /**
     * Авторизация пользователей (проверка логина и пароля, запись в сессию id пользователя)
     * @return void
     */
    public function login()
    {
        if ($_POST['login'] !== '' && $_POST['password'] !== '') //проверка на заполненность формы авторизации (на всякий случай)
        {
            $login = $_POST['login'];
            $password = (md5($_POST['password']));

            $user_model = new UserModels();
            $check_user = $user_model->getAuth($login, $password); //проверка существования пользователя в базе

            if (isset($check_user))
            {
                $_SESSION['id_user'] = $check_user->getIdUser(); //запись идентификатора пользователя(записываю id_user)
                View::redirect('/');
            } else //в случае
            {
                $_SESSION['msg'] = 'Неправильный логин или пароль';
                View::redirect('/account/indexLogin');
            }

        } else //в случае если поля не заполнены вывожу сообщение и возвращаю на страницу авторизации
        {
            $_SESSION['msg'] = 'Введите логин и пароль';
            View::redirect('/account/indexLogin');
        }
    }

    /**
     * Завершение сессии пользователя (разлогинивание и удаление идентификатора из сессии)
     * @return void
     */
    public function logout()
    {
        session_destroy();
        View::redirect('/');
        exit;
    }
}