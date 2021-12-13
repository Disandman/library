<?php
/** @var object $entityManager */
/** @var string $user_name */

/** @var string $user_role */

use App\config\DB_connect;

$modelUser = new \App\models\Access();
$user = $modelUser->getUser();

$entityManagerClass = new DB_connect();
$entityManager = $entityManagerClass->connect();

$emtyUserModel = new \App\models\UserModels();
$emtyUser = $emtyUserModel->getAll();


?>
<!DOCTYPE html>
<html>
<head>
    <title><?php /** @var void $title */
        echo $title; ?></title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <script type="text/javascript" src="/js/bootstrap.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="/"><img src="/img/books.png" style="width: 2rem;" class="pull-left"/></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (!empty($emtyUser)) : ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Главная</a>
                    </li>
                    <?php
                    if ($modelUser->getRole('Администратор')): ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/books/index">Книги</a>
                    </li>

                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/readers-ticket/index">Читатели</a>
                        </li>

                    <li class="nav-item dropdown dropstart ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown"
                           style="position: relative; text-align:right">Структура ВУЗа</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/division/index">Подразделения</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/group/index">Группы</a></li>
                        </ul>
                    </li>

                        <li class="nav-item"><a class="nav-link" aria-current="page" href="/user/index">Пользователи</a></li>
                    <?php endif;?>
                    <?php if (!empty($_SESSION['id_user'])) { ?>
                        <li class="nav-item dropdown dropstart ">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown"
                               style="position: relative; text-align:right"><?= $user->getLogin() ?></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Профиль</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/account/logout">Выход</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/account/indexLogin">Вход</a>
                        </li>
                    <?php } endif; ?>

                </ul>
            </div>
        </div>
    </nav>
</header>
<main role="main" class="flex-shrink-0">
    <div class="container">
        <?php /** @var void $content */
        echo $content; ?>
    </div>
</main>
<footer class="footer fixed-bottom bg-light">
    <div class="container">
        <p class="pull text-center">&copy; <?php echo date('Y') ?></p>
    </div>
</footer>
</body>
</html>