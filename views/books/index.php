<div class="bg-light">
    <?php

    use App\config\DB_connect;

    \App\core\Breadcrumb::add_current('/user/index', 'Книги');
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
            <th scope="col">Название</th>
            <th scope="col">Автор</th>
            <th scope="col">Дата публикации</th>
            <th width="120"></th>
        </tr>
        </thead>
        <?php foreach ($model as $models) : ?>
            <tr>

                <td align="left"><?php echo $models->getNameBooks(); ?></td>
                <td align="left"><?php echo $models->getAuthor(); ?></td>
                <td align="left"><?php echo $models->getDatePublication(); ?></td>
                <td>
                    <a href="/books/view?id=<?php echo $models->getIdBooks(); ?>"" class="btn btn-outline-info
                    btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="/books/update?id=<?php echo $models->getIdBooks(); ?>"
                       class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                    <a href="/books/delete?id=<?php echo $models->getIdBooks(); ?>"
                       class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="col-md-2 text-right">
        <a href="/books/create" class="btn btn-success">Добавить</a>
    </div>

