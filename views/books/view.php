<?php

use App\core\Breadcrumb;

Breadcrumb::add('/books/index', 'Книги');
Breadcrumb::add_current('/books/view', 'Просмотр книги');

/** @var array $model */
/** @var array $access */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>
<div class="card">
    <table class="table table-hover">
        <tr>
            <th scope="col">Уникальный номер</th>
            <td><?php echo $model->getIdBooks() ?></td>
        </tr>
        <tr>
            <th scope="col">Название</th>
            <td><?php echo $model->getNameBooks() ?></td>
        </tr>
        <tr>
            <th scope="col">Автор</th>
            <td><?php echo $model->getAuthor() ?></td>
        </tr>

        <tr>
            <th scope="col">Описание</th>
            <td><?php echo $model->getDescription() ?></td>
        </tr>
        <tr>
            <th scope="col">Цена</th>
            <td><?php echo $model->getPriceBooks() ?></td>
        </tr>
        <tr>
            <th scope="col">Дата публикации:</th>
            <td><?php echo $model->getDatePublication() ?></td>
        </tr>
        <tr>
            <th scope="col">Дата получения:</th>
            <td ><?php echo $model->getDateReceipt() ?></td>
        </tr>
    </table>
    <div class="container text-center">
        <?php if ($access->getRole('Администратор') || $access->getRole('Сотрудник библиотеки')) : ?>
            <a class="btn btn-outline-primary" href="/books/update?id=<?php echo $model->getIdBooks() ?>">Изменить</a>
        <?php endif; ?>
        <a class="btn btn-outline-info" href="/books/index">Назад</a>
    </div>
</div>









