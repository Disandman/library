<div class="bg-light">
    <?php
    \App\core\Breadcrumb::add('/books/index', 'Книги');
    \App\core\Breadcrumb::add_current('/books/create', 'Добавление книги');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    /** @var array $role */
    ?>
</div>


<div class="col">
    <h1>Добавление книги</h1>
</div>

<form method="post" action="/books/create">
    <div class="form-group">
        <label for="name">Название</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <br>
    <div class="form-group">
        <label for="author">Автор</label>
        <input type="text" class="form-control" id="author" name="author">
    </div>
    <br>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Описание</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
    </div>
    <br>

    <div class="form-group">
        <label for="price">Цена</label>
        <input type="text" class="form-control" id="price" name="price">
    </div>
    <br>

    <div class="form-group">
        <label for="date_publication">Дата публикации:</label>
        <input type="date" class="form-control" id="date_publication" name="date_publication">
    </div>
    <br>
    <div class="form-group">
        <label for="date_receipt">Дата получения:</label>
        <input type="date" class="form-control" id="date_receipt" name="date_receipt">
    </div>
    <br>
    <button type="submit" class="btn btn-outline-success">Создать</button>
</form>