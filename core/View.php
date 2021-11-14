<?php

namespace App\core;

class View
{
    /**
     * Render a view file
     * @param string $title  The title
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($title, $view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/views/$view";
        $default = dirname(__DIR__) . "/views/layouts/default.php";

        if (is_readable($file)) {
            ob_start();
            require $file;
            $content = ob_get_clean();
            require $default;
        } else {
            throw new \Exception("$file not found");
        }
    }
    public static function redirect($url) {
        header('location: '.$url);
        exit;
    }
}
