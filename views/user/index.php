<div class="bg-light">
<?php
\App\core\Breadcrumb::add_current('/user/index', 'Пользователи');
echo \App\core\Breadcrumb::out();
require dirname(__DIR__) . '/../config/bootstrap.php';

/** @var array $model */
?>
</div>



    <div class="col">
        <h1>Пользователи</h1>
    </div>


<div>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Логин</th>
            <th scope="col">Статус</th>
            <th scope="col">Роль</th>
            <th width="120"></th>
        </tr>
        </thead>
        <?php foreach($model as $models) : ?>
            <tr>
                <td align="left"><?php echo $models->getFullName(); ?></td>
                <td align="left"><?php echo $models->getLogin(); ?></td>
                <td align="left"><?php /** @var object $entityManager */
                     echo $entityManager->getRepository(':Role')->find($models->getRole())->getName(); ?></td>
                <td align="left"><?php echo \App\models\UserModels::$status[$models->getActive()]; ?></td>
                <td>
                    <a href="/user/view" class="btn btn-outline-info btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="/user/update" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                    <a href="/user/delete?id=5" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="col-md-2 text-right">
        <a href="/user/create" class="btn btn-success">Добавить</a>
    </div>