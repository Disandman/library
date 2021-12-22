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
    <form method="get" action="/group/index">
    <tr>
        <th scope="col">Группа<input type="text" class="form-control" placeholder="Найти группу..." id="group_name" name="group_name" value="<?php echo !empty($_GET['group_name']) ? $_GET['group_name']:''?>"></th>
        <th width="120"></th>
        <input type="submit" hidden="true" />
    </tr>
    </form>
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

