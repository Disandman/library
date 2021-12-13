<div class="bg-light">
    <?php

    use App\config\DB_connect;

    \App\core\Breadcrumb::add('/user/index', 'Книги');
    \App\core\Breadcrumb::add_current('/user/view', 'Просмотр книги');
    echo \App\core\Breadcrumb::out();

    $entityManagerClass = new DB_connect();
    $entityManager = $entityManagerClass->connect();

    /** @var array $model */
    ?>
</div>

<div class="card">
    <table class="table table-hover">
        <tr>
            <th scope="col">id</th>
            <td align="left"><?php echo $model->getIdBooks(); ?></td>
        </tr>
        <tr>
            <th scope="col">Название</th>
            <td align="left"><?php echo $model->getNameBooks(); ?></td>
        </tr>
        <tr>
            <th scope="col">Автор</th>
            <td align="left"><?php echo $model->getAuthor(); ?></td>
        </tr>
        <tr>
            <th scope="col">Цена</th>
            <td align="left"><?php echo $model->getPriceBooks() ?></td>
        </tr>
        <tr>
            <th scope="col">Дата публикации:</th>
            <td align="left"><?php echo $model->getDatePublication() ?></td>
        </tr>
        <tr>
            <th scope="col">Дата получения:</th>
            <td align="left"><?php echo $model->getDateReceipt() ?></td>
        </tr>
        <tr>
            <th scope="col">Дата потери:</th>
            <td align="left"><?php echo $model->getDateLost() ?></td>
        </tr>
    </table>
    <div class="container text-center">
        <a href="/books/index" class="btn btn-outline-info">Назад</a>
        <a href="/books/update?id=<?php echo $model->getIdBooks(); ?>" class="btn btn-outline-primary">Изменить</a>
    </div>


</div>









