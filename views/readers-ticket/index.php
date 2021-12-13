<div class="bg-light">
    <?php

    use App\config\DB_connect;

    \App\core\Breadcrumb::add_current('/readers-ticket/index', 'Читатели');
    echo \App\core\Breadcrumb::out();
    $entityManagerClass = new DB_connect();
    $entityManager = $entityManagerClass->connect();
    /** @var array $model */
    ?>
</div>


<br>
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Подразделение</th>
            <th scope="col">Курс</th>
            <th scope="col">Группа</th>
            <th scope="col">Статус</th>
            <th scope="col">Дата блокировки</th>
            <th scope="col">Дата разблокировки</th>
            <th scope="col">Книги на руках</th>
            <th width="120"></th>
        </tr>
        </thead>
        <?php foreach ($model as $models) : ?>
            <tr>

                <td align="left"><a href="/user/view?id=<?php echo $models->getIdUser()?>"><?php /** @var object $entityManager */
                    echo $entityManager->getRepository(':User')->find($models->getIdUser())->getFullName(); ?></a></td>

                <td align="left"><?php /** @var object $entityManager */
                    echo $entityManager->getRepository(':Division')->find($models->getIdDivision())->getDivision(); ?></td>

                <td align="left"><?php echo \App\models\ReadersTicketModel::$course[$models->getIdCourse()]; ?></td>

                <td align="left"><?php /** @var object $entityManager */
                    echo $entityManager->getRepository(':Group')->find($models->getIdGroup())->getGroupName(); ?></td>


                <td align="left"><?php echo \App\models\UserModels::$status[$models->getBlock()]; ?></td>


                <td align="left"><?php echo $models->getDateBlocking(); ?></td>
                <td align="left"><?php echo $models->getDateUnblocking(); ?></td>
                <td align="left"></td>


                <td>
                    <a href="/readersTicket/update?id=<?php echo $models->getIdReadersTicket(); ?>"
                       class="btn btn-outline-primary btn-sm"><i class="bi bi-lock-fill"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

