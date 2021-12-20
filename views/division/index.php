<?php

use App\core\Breadcrumb;

Breadcrumb::add_current('/division/index', 'Подразделения');

/** @var array $model */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>
<br>
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Подразделение</th>
            <th width="120"></th>
        </tr>
        </thead>
        <?php foreach ($model as $models) : ?>
            <tr>
                <td align="left"><?php echo $models->getDivision(); ?></td>
                <td>
                    <a href="/division/update?id=<?php echo $models->getIdDivision(); ?>"
                       class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                    <a href="/division/delete?id=<?php echo $models->getIdDivision(); ?>"
                       class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="col-md-2 text-right">
        <a href="/division/create" class="btn btn-success">Добавить</a>
    </div>

