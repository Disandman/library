<?php

namespace App\core;

class Paginator
{

    public function getModelResultPage($count,$maxResult){
        $firstResult = 0;//начало записей
        global $countRecords;
        $countRecords = $count;
        if (!empty($_GET['page'])) {
            if ($_GET['page'] == 1){
                $firstResult = 0;
            }
            else{
                $firstResult = ($_GET['page']-1) * $maxResult;
            }
        }
        return$firstResult;
    }



    public function getCount(){
        global $countRecords;

        return round($countRecords/10);
    }

}