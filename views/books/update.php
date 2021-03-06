<?php

use App\core\Breadcrumb;

Breadcrumb::add('/books/index', 'Книги');
Breadcrumb::add_current('/books/create', 'Изменение книги');

/** @var array $model */
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>
<div class="col">
    <h1>Изменение: <?php echo $model->getNameBooks() ?></h1>
</div>
<form method="post" action="/books/update?id=<?php echo $model->getIdBooks() ?>">
    <div class="form-group">
        <label for="name">Название</label>
        <input type="text" class="form-control" id="name" value="<?php echo $model->getNameBooks() ?>" name="name">
    </div>
    <br>
    <div class="form-group">
        <label for="author">Автор</label>
        <input type="text" class="form-control" id="author" value="<?php echo $model->getAuthor() ?>" name="author">
    </div>
    <br>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Описание</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?php echo $model->getDescription() ?></textarea>
    </div>
    <br>
    <div class="form-group">
        <label for="price">Цена</label>
        <input type="text" class="form-control" id="price" value="<?php echo $model->getPriceBooks() ?>" name="price">
    </div>
    <br>

    <div class="form-group">
        <label for="date_publication">Дата публикации:</label>
        <input type="date" class="form-control" id="date_publication" value="<?php echo $model->getDatePublication() ?>" name="date_publication">
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>