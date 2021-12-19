<div class="bg-light">
    <?php

    use App\config\DB_connect;

    \App\core\Breadcrumb::add_current('/group/index', 'Нарушения');
    echo \App\core\Breadcrumb::out();
    $entityManagerClass = new DB_connect();
    $entityManager = $entityManagerClass->connect();
    /** @var array $model */
    ?>
</div>

<br>
<table class="table table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Нарушение</th>
        <th scope="col">Сумма</th>
        <th width="120"></th>
    </tr>
    </thead>
    <?php foreach ($model as $models) : ?>
        <tr>

            <td align="left"><?php echo $models->getNameViolations(); ?></td>
            <td align="left"><?php echo $models->getPriceViolations(); ?></td>
            <td>
                <a href="/violation/update?id=<?php echo $models->getIdViolation(); ?>"
                   class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                <a href="/violation/delete?id=<?php echo $models->getIdViolation(); ?>"
                   class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="col-md-2 text-right">
    <a href="/violation/create" class="btn btn-success">Добавить</a>
</div>

