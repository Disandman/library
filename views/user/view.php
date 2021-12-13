<div class="bg-light">
    <?php

    use App\config\DB_connect;

    \App\core\Breadcrumb::add('/user/index', 'Пользователи');
    \App\core\Breadcrumb::add_current('/user/view', 'Просмотр пользователя');
    echo \App\core\Breadcrumb::out();

    $entityManagerClass = new DB_connect();
    $entityManager = $entityManagerClass->connect();

    /** @var array $model */
    /** @var array $readersTicket */
    /** @var object $entityManager */
    ?>
</div>

<div class="card">
    <table class="table table-hover">
        <tr>
            <th scope="col">id</th>
            <td align="left"><?php echo $model->getIdUser();?></td>
        </tr>
        <tr>
            <th scope="col">ФИО</th>
            <td align="left"><?php echo $model->getFullName();?></td>
        </tr>
        <tr>
            <th scope="col">Подразделение</th>
            <td align="left">
                <?php echo $entityManager->getRepository(':Division')->find($readersTicket->getIdDivision())->getDivision();?>
            </td>
        </tr>
        <tr>
            <th scope="col">Курс</th>
            <td align="left">
                <?php echo \App\models\ReadersTicketModel::$course[$readersTicket->getIdCourse()];?>
            </td>
        </tr>
        <tr>
            <th scope="col">Группа</th>
            <td align="left">
                <?php echo $entityManager->getRepository(':Group')->find($readersTicket->getIdGroup())->getGroupName();?>
            </td>
        </tr>
        <tr>
            <th scope="col">Логин</th>
            <td align="left"><?php echo $model->getLogin();?></td>
        </tr>
        <tr>
            <th scope="col">Роль</th>
            <td align="left">
                <?php echo $entityManager->getRepository(':Role')->find($model->getRole())->getName();?>
            </td>
        </tr>
        <tr>
            <th scope="col">Статус</th>
            <td align="left"><?php echo \App\models\UserModels::$status[$model->getActive()]; ?></td>
        </tr>
    </table>
    <div class="container text-center">
        <a href="/user/index" class="btn btn-outline-info">Назад</a>
        <a href="/user/update?id=<?php echo $model->getIdUser();?>" class="btn btn-outline-primary">Изменить</a>
    </div>


</div>









