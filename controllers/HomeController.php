<?php

namespace App\controllers;

use App\core\Controller;
use App\core\View;

/**
 * HomeController controller
 */
class HomeController extends Controller
{

    /**
     * @return void
     */
    public function index()
    {
        View::render('Главная страница','site/index.php');
    }
}
