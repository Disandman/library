<?php

namespace App\core;

class Paginator
{

    public function getModelResultPage($count, $maxResult)
    {
        $firstResult = 0;//начало записей
        global $countRecords;
        $countRecords = $count;
        if (!empty($_GET['page'])) {
            if ($_GET['page'] == 1) {
                $firstResult = 0;
            } else {
                $firstResult = ($_GET['page'] - 1) * $maxResult;
            }
        }
        return $firstResult;
    }


    public function getViewPaginator()
    {
        global $countRecords;

        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $url = $url[0];

        $count = ceil($countRecords / 10);
        if (empty($_GET['page']))
            $_GET['page'] = 1;

        $prev = $_GET['page'] == 1 ? 'disabled' : '';
        $pos = $_GET['page'] == $count || $count < 2 ? 'disabled' : '';
        $pred = ($_GET['page'] - 1);
        $next = ($_GET['page'] + 1);


        for ($i = 1; $i <= $count; $i++) {

            $active = $_GET['page'] == $i ? 'active' : '';
            $page [] = '<li class="page-item ' . $active . '"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>';

        }


        if (!empty($page)) {
            $pages = implode($page);
        } else {
            $pages = '<li class="page-item active" disabled="true"><a class="page-link" href="' . $url . '?page=1">1</a></li>';
        }


        $paginator = '<nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item ' . $prev . '">
                <a class="page-link" href="' . $url . '?page=' . $pred . '">Предыдущая</a>
            </li>
            ' . $pages . '
            <li class="page-item ' . $pos . '">
                <a class="page-link" href="' . $url . '?page=' . $next . '">Следующая</a>
            </li>
        </ul>
    </nav>';


        return $paginator;
    }

}