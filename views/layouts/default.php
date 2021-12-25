<?php
/** @var object $entityManager */
/** @var string $user_name */
/** @var string $user_role */
/** @var void $title */
/** @var void $content */


$modelUser = new \App\models\UserModels();
$user = $modelUser->getUser();
$access = new \App\models\Access();

$emptyUser = $modelUser->getAllDB();
$user = $modelUser->getUser();

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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
                    <?php if (!empty($emptyUser)) : ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Главная</a>
                        </li>
                        <?php if (!empty($_SESSION['id_user'])) : ?>
                            <?php if (!$access->getRole('Администратор') && !$access->getRole('Сотрудник библиотеки')) {?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="/books-user/index">Мои Книги</a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/books/index">Книги</a>
                            </li>
                        <?php endif;
                        if ($access->getRole('Администратор') || $access->getRole('Сотрудник библиотеки')): ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/readers-ticket/index">Читатели</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" aria-current="page" href="/violation/index">Нарушения</a>
                            </li>
                        <?php endif; ?>
                            <?php if ($access->getRole('Администратор')) : ?>
                            <li class="nav-item dropdown dropstart ">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                   data-bs-toggle="dropdown"
                                   style="position: relative; text-align:right">Структура ВУЗа</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/division/index">Подразделения</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/group/index">Группы</a></li>
                                </ul>
                            </li>

                            <li class="nav-item"><a class="nav-link" aria-current="page"
                                                    href="/user/index">Пользователи</a></li>
                        <?php endif; ?>
                        <?php if (!empty($_SESSION['id_user'])) { ?>
                            <li class="nav-item dropdown dropstart ">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                   data-bs-toggle="dropdown"
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
        <?php echo $content; ?>
        <div>&#160;</div>
    </div>
</main>
<footer class="footer fixed-bottom bg-light">
    <div class="container">
        <p class="pull text-center">&copy; <?php echo date('Y') ?></p>
    </div>
</footer>
</body>
</html>