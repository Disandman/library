<div class="bg-light">
    <?php

    \App\core\Breadcrumb::add('/books/index', 'Книги');
    \App\core\Breadcrumb::add_current('/books/create', 'Изменение книги');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    ?>
</div>


<div class="col">
    <h1>Изменение: <?php echo $model->getNameBooks() ?></h1>
</div>

<form method="post" action="/books/update?id=<?php echo $model->getIdBooks(); ?>">


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
        <label for="price">Цена</label>
        <input type="text" class="form-control" id="price" value="<?php echo $model->getPriceBooks() ?>" name="price">
    </div>
    <br>

    <div class="form-group">
        <label for="date_publication">Дата публикации:</label>
        <input type="date" class="form-control" id="date_publication" value="<?php echo $model->getDatePublication() ?>"
               name="date_publication">
    </div>
    <br>
    <div class="form-group">
        <label for="date_receipt">Дата получения:</label>
        <input type="date" class="form-control" id="date_receipt" value="<?php echo $model->getDateReceipt() ?>"
               name="date_receipt">
    </div>
    <br>
    <div class="form-group">
        <label for="date_lost"></label>
        <input type="date" class="form-control" id="date_lost" value="<?php echo $model->getDateLost() ?>"
               name="date_lost">
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>