<div class="bg-light">
    <?php

    use App\config\DB_connect;

    \App\core\Breadcrumb::add_current('/user/index', 'Пользователи');
    echo \App\core\Breadcrumb::out();

    $entityManagerClass = new DB_connect();
    $entityManager = $entityManagerClass->connect();

    /** @var array $model */
    /** @var array $readersTicket */
    ?>
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
            <tr>
                <th scope="col">ФИО</th>
                <th scope="col">Логин</th>
                <th scope="col">Роль</th>
                <th scope="col">Должность</th>
                <th scope="col">Статус</th>
                <th width="120"></th>
            </tr>
            </thead>
            <?php foreach ($model as $models) : ?>
                <tr>

                    <td align="left"><?php echo $models->getFullName(); ?></td>
                    <td align="left"><?php echo $models->getLogin(); ?></td>
                    <td align="left"><?php /** @var object $entityManager */
                        echo $entityManager->getRepository(':Role')->find($models->getRole())->getName(); ?></td>
                    <td align="left">
                        <?php $result = $readersTicket->getIdUser($models->getIdUser());
                        echo \App\models\ReadersTicketModel::$position[$result->getIdPosition()];?>
                    </td>
                    <td align="left"><?php echo \App\models\UserModels::$status[$models->getActive()]; ?></td>
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

