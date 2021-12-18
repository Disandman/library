<?php

namespace App\controllers;

use App\core\View;

/**
 * Контроллер сайта
 */
class HomeController
{
    /**
     * Вывод страницы с описанием приложения (и котиком)
     * @throws \Exception
     */
    public function index()
    {
        View::render('Главная страница', 'site/index.php');
    }

    /**
     * Страница инициализации проекта
     * @throws \Exception
     */
    public function indexInit()
    {
        View::render('Инициализация приложения', 'site/init.php');
    }
}
