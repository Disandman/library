<div class="bg-light">
<?php
\App\core\Breadcrumb::add_current('/role/index', 'Роли');
echo \App\core\Breadcrumb::out();
require dirname(__DIR__) . '/../config/bootstrap.php';

/** @var array $model */
?>
</div>



    <div class="col">
        <h1>Роли</h1>
    </div>


<div>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Роль</th>
            <th width="120"></th>
        </tr>
        </thead>
        <?php foreach($model as $models) : ?>
            <tr>
                <td align="left"><?php echo $models->getName(); ?></td>
                <td>
                    <a href="/user/view" class="btn btn-outline-info btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="/user/update" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                    <a href="/user/delete?id=5" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="col-md-2 text-right">
        <a href="/role/create" class="btn btn-success">Добавить</a>
    </div>