<?php

use App\core\Breadcrumb;

Breadcrumb::add_current('/user/index', 'Пользователи');

/** @var array $model */
/** @var array $role */
/** @var array $user */
/** @var array $readersTicket */
?>

<script>
    $(document).ready(function() {
        $('#searchInput').AddXbutton('text');
        $('#searchInput').focus();
    });
    (function($) {
        $.fn.AddXbutton = function(options) {
            var defaults = {
                img: 'x.gif'//расположение картинки крестика по-умолчанию (относительно страницы, на которой находится инпут)
            };
            var opts = $.extend(defaults, options);
            $(this)
                .after($('<input type="image" id="xButton" src="' + opts['img'] + '" />') //после текстового инпута вставляем image-input
                    .css({ 'display': 'none', 'cursor': 'pointer', 'marginLeft': '-15px' })// делаем его стильным
                    .click(function() { //вешаем обработчик на клик
                        $('#searchInput').val('').focus();
                        $('#xButton').hide();
                    }))
                .keyup(function() { //на кейап мы проверяем, показывать нам крестик или нет
                    if ($(this).val().length > 0) {
                        $('#xButton').show(); //если текст какой-нибудь есть, но показываем
                    } else {
                        $('#xButton').hide();
                    }
                });
            if ($(this).val() != '') $('#xButton').show(); //если при загрузке страницы в текстовом поле что-то есть, крестик надо сразу показать (например, при обновлении страницы)
        };
    })(jQuery);
</script>
<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>

<br>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Пользователи
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Роли
        </button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-hover">
            <thead class="thead-dark">
            <form method="get" action="/user/index">
            <tr>
                <th scope="col">ФИО<input type="text" class="form-control" id="full_name" name="full_name" id="searchInput"  value="<?php echo !empty($_GET['full_name']) ? $_GET['full_name']:''?>"></th>
                <th scope="col">Логин<input type="text" class="form-control" id="login" name="login" value="<?php echo !empty($_GET['login']) ? $_GET['login']:''?>"></th>
                <th scope="col">Роль</th>
                <th scope="col">Должность</th>
                <th scope="col">Статус</th>
                <th width="120"> <a href="/user/index" class="btn btn-danger btn-sm">сбросить поиск</a></th>

                <input type="submit" hidden="true" />
            </tr>
            </form>
            </thead>
            <?php foreach ($model as $models) : ?>
                <tr>
                    <td align="left"><?php echo $models->getFullName(); ?></td>
                    <td align="left"><?php echo $models->getLogin(); ?></td>
                    <td align="left"><?php echo $user->getUserRole($models->getRole())?></td>
                    <td align="left">
                        <?php $result = $readersTicket->getIdUser($models->getIdUser());
                        echo $readersTicket->getPositionId($result->getIdPosition());?>
                    </td>
                    <td align="left"><?php echo $readersTicket->getUserStatus($models->getActive())?></td>
                    <td>
                        <a href="/user/view?id=<?php echo $models->getIdUser(); ?>"" class="btn btn-outline-info
                        btn-sm"><i class="bi bi-eye"></i></a>
                        <a href="/user/update?id=<?php echo $models->getIdUser(); ?>"
                           class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="/user/delete?id=<?php echo $models->getIdUser(); ?>"
                           class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="col-md-2 text-right">
            <a href="/user/create" class="btn btn-success">Добавить</a>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Роль</th>
                <th width="120"></th>
            </tr>
            </thead>
            <?php foreach ($role as $roles) : ?>
                <tr>
                    <td align="left"><?php echo $roles->getName(); ?></td>
                    <td>
                        <a href="/role/update?id=<?php echo $roles->getIdRole(); ?>"
                           class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="/role/delete?id=<?php echo $roles->getIdRole(); ?>"
                           class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="col-md-2 text-right">
            <a href="/role/create" class="btn btn-success">Добавить</a>
        </div>
    </div>

