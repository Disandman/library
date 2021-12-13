<?php

namespace App\controllers;

use App\core\Controller;
use App\core\View;
use App\models\AcademicDegreeModels;

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
        View::render('Главная страница', 'site/index.php');
    }


    /**
     * @return void
     */
    public function indexInit()
    {
        View::render('Главная страница', 'site/init.php');
    }

}
