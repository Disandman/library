<div class="bg-light">
    <?php
    \App\core\Breadcrumb::add('/user/index', 'Пользователи');
    \App\core\Breadcrumb::add_current('/user/view', 'Просмотр пользователя');
    echo \App\core\Breadcrumb::out();
    require dirname(__DIR__) . '/../config/bootstrap.php';

    /** @var array $model */
    ?>
</div>

<div class="card">
    <table class="table table-hover">
        <tr>
            <th scope="col">id</th>
            <td align="left"><?php echo $model->getIdUser(); ?></td>
        </tr>
        <tr>
            <th scope="col">ФИО</th>
            <td align="left"><?php echo $model->getFullName(); ?></td>
        </tr>
        <tr>
            <th scope="col">Логин</th>
            <td align="left"><?php echo $model->getLogin(); ?></td>
        </tr>
        <tr>
            <th scope="col">Роль</th>
            <td align="left"><?php /** @var object $entityManager */
                echo $entityManager->getRepository(':Role')->find($model->getRole())->getName(); ?></td>
        </tr>
        <tr>
            <th scope="col">Статус</th>
            <td align="left"><?php echo \App\models\UserModels::$status[$model->getActive()]; ?></td>
        </tr>
    </table>
    <div class="container text-center">
        <a href="/user/update?id=<?php echo $model->getIdUser(); ?>" class="btn btn-outline-primary">Изменить</a>
        <a href="/user/index" class="btn btn-outline-primary">Назад</a>
    </div>


</div>









