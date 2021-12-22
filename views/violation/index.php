<?php

use App\core\Breadcrumb;

Breadcrumb::add_current('/violation/index', 'Нарушения');

/** @var array $model */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>
<br>
<table class="table table-hover">
    <thead class="thead-dark">
    <form method="get" action="/violation/index">
    <tr>
        <th scope="col">Нарушение<input type="text" class="form-control" id="name_violations" name="name_violations" value="<?php echo !empty($_GET['name_violations']) ? $_GET['name_violations']:''?>"></th>
        <th scope="col">Сумма<input type="text" class="form-control" id="price_violations" name="price_violations" value="<?php echo !empty($_GET['price_violations']) ? $_GET['price_violations']:''?>"></th>
        <th width="120"></th>
        <input type="submit" hidden="true" />
    </tr>
    </form>
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

