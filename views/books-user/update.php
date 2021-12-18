<div class="bg-light">
    <?php

    use App\config\DB_connect;

    \App\core\Breadcrumb::add('/readers-ticket/index', ' Читатели');
    \App\core\Breadcrumb::add_current('/readers-ticket/update', 'Блокировка читателя');
    echo \App\core\Breadcrumb::out();

    /** @var array $model */
    $entityManagerClass = new DB_connect();
    $entityManager = $entityManagerClass->connect();
    ?>
</div>


<div class="col">
    <h1>Блокировка: <?php echo $entityManager->getRepository(':User')->find($model->getIdUser())->getFullName(); ?></h1>
</div>

<form method="post" action="/readers-ticket/update?id=<?php echo $model->getIdReadersTicket(); ?>">


    <input type="radio" class="btn-check" name="block" value="1" id="success-outlined" autocomplete="off" <?php echo $model->getBlock() == 1 ? 'checked' : ''?>>
    <label class="btn btn-outline-info" for="success-outlined">Активен</label>

    <input type="radio" class="btn-check" name="block" value="0" id="danger-outlined" autocomplete="off" <?php echo $model->getBlock() == 0 ? 'checked' : ''?>>
    <label class="btn btn-outline-danger" for="danger-outlined">Заблокирован</label>
    <br>
    <br>
    <div class="form-group">
        <label for="date_publication">Дата блокировки:</label>
        <input type="date" class="form-control" id="date_publication" value="<?php echo $model->getDateBlocking() ?>" name="date_blocking">
    </div>
    <br>
    <div class="form-group">
        <label for="date_receipt">Дата разблокировки:</label>
        <input type="date" class="form-control" id="date_receipt" value="<?php echo $model->getDateUnblocking() ?>" name="date_unblocking">
    </div>
    <br>

    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>
<script>
    var filterDay = $('#filterDay input:radio:checked').val()
</script>