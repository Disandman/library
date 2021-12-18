<?php
use App\core\Breadcrumb;

/** @var array $model */
/** @var array $access */
?>
<div class="bg-light">
    <?php
    Breadcrumb::add('/books/index', 'Книги');
    Breadcrumb::add_current('/books/view', 'Просмотр книги');
    echo Breadcrumb::out(); ?>
</div>
<div class="card">
    <table class="table table-hover">
        <tr>
            <th scope="col">Уникальный номер</th>
            <td align="left"><?php echo $model->getIdBooks() ?></td>
        </tr>
        <tr>
            <th scope="col">Название</th>
            <td align="left"><?php echo $model->getNameBooks() ?></td>
        </tr>
        <tr>
            <th scope="col">Автор</th>
            <td align="left"><?php echo $model->getAuthor() ?></td>
        </tr>

        <tr>
            <th scope="col">Описание</th>
            <td align="left"><?php echo $model->getDescription() ?></td>
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
    </table>
    <div class="container text-center">
        <?php if ($access->getRole('Администратор') || $access->getRole('Сотрудник библиотеки')) : ?>
            <a href="/books/update?id=<?php echo $model->getIdBooks() ?>" class="btn btn-outline-primary">Изменить</a>
        <?php endif; ?>
        <a href="/books/index" class="btn btn-outline-info">Назад</a>
    </div>
</div>









