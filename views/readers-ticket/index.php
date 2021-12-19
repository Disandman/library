<div class="bg-light">
    <?php

    use App\config\DB_connect;
    use App\models\ReadersTicketModel;
    use App\models\UserModels;

    \App\core\Breadcrumb::add_current('/readers-ticket/index', 'Читатели');
    echo \App\core\Breadcrumb::out();
    $entityManagerClass = new DB_connect();
    $entityManager = $entityManagerClass->connect();
    /** @var array $model */
    /** @var object $entityManager */
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
            <th width="120"></th>
        </tr>
        </thead>
        <?php foreach ($model as $models) : ?>
            <tr>
                <td align="left">
                    <a href="/user/view?id=<?php echo $models->getIdUser() ?>"><?php echo $entityManager->getRepository(':User')->find($models->getIdUser())->getFullName()?></a>
                </td>
                <td align="left"><?php echo !empty($models->getIdDivision()) ? $entityManager->getRepository(':Division')->find($models->getIdDivision())->getDivision() : ''?></td>
                <td align="left"><?php echo !empty($models->getIdCourse()) ? ReadersTicketModel::$course[$models->getIdCourse()] : ''?></td>
                <td align="left"><?php echo !empty($models->getIdGroup()) ? $entityManager->getRepository(':Group')->find($models->getIdGroup())->getGroupName():''?></td>
                <td align="left"><?php echo UserModels::$status[$models->getBlock()]; ?></td>
                <td align="left"><?php echo $models->getDateBlocking(); ?></td>
                <td align="left"><?php echo $models->getDateUnblocking(); ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/books-user/index?id=<?php echo $entityManager->getRepository(':User')->find($models->getIdUser())->getIdUser() ?>"
                           class="btn btn-outline-primary btn-sm">Книги читателя</a>
                        <a href="/readers-ticket/block?id=<?php echo $models->getIdReadersTicket(); ?>"
                        <?php echo $models->getBlock() == 0 ? 'class="btn btn-danger btn-sm"><i class="bi bi-lock"></i>' : 'class="btn btn-success btn-sm"><i class="bi bi-unlock"></i>'; ?>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

