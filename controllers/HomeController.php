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
        $ADM = new AcademicDegreeModels();
        $result = $ADM->getIndex();
        $model = [
            'model' => $result,
        ];
        View::render('Главная страница','site/index.php',$model);
    }

}
