<?php

use App\core\Breadcrumb;

Breadcrumb::add_current('/group/index', 'Группы');

/** @var array $model */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>
<br>
<table class="table table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Группа</th>
        <th width="120"></th>
    </tr>
    </thead>
    <?php foreach ($model as $models) : ?>
        <tr>
            <td align="left"><?php echo $models->getGroupName(); ?></td>
            <td>
                <a href="/group/update?id=<?php echo $models->getIdGroup(); ?>"
                   class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                <a href="/group/delete?id=<?php echo $models->getIdGroup(); ?>"
                   class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="col-md-2 text-right">
    <a href="/group/create" class="btn btn-success">Добавить</a>
</div>

