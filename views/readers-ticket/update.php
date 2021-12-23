<?php

use App\core\Breadcrumb;

Breadcrumb::add('/readers-ticket/index', 'Читатели');
Breadcrumb::add_current('/readers-ticket/update', 'Блокировка читателя');

/** @var array $model */
/** @var string $readersTicketModel */
?>
<script>
    var filterDay = $('#filterDay input:radio:checked').val();
    $('select').selectpicker();
</script>
<style>
    .date {
        display: none;
    }

    #danger-outlined:checked ~ .show-on {
        display: block;
    }
</style>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>

<div class="col">
    <h1>Блокировка: <?php echo $readersTicketModel->getUserName($model->getIdUser()) ?></h1>
</div>
<form method="post" action="/readers-ticket/block?id=<?php echo $model->getIdReadersTicket(); ?>">
    <input type="radio" class="btn-check" name="block" value="1" id="success-outlined"
           autocomplete="off" <?php echo $model->getBlock() == 1 ? 'checked' : '' ?>>
    <label class="btn btn-outline-info" for="success-outlined">Активен</label>
    <input type="radio" class="btn-check" name="block" value="0" id="danger-outlined"
           autocomplete="off" <?php echo $model->getBlock() == 0 ? 'checked' : '' ?>>
    <label class="btn btn-outline-danger" for="danger-outlined">Заблокирован</label>
    <br>
    <br>
    <div class="date show-on">
        <div class="form-group">
            <label for="date_receipt">Дата разблокировки:</label>
            <input type="date" class="form-control" id="date_receipt" value="<?php echo $model->getDateUnblocking() ?>"
                   name="date_unblocking">
        <br>
        <label for="date_receipt">Нарушения:</label>
        <select class="selectpicker form-control" multiple data-live-search="true" title="Выберите нарушение" id="violation" name="violation[]">
            <?php foreach ($violationModel as $violationModels) : ?>
                <option <?php if (!empty($resultConnectViolation)) foreach ($resultConnectViolation as $resultConnectViolations){ echo  $violationModels->getIdViolation() == $resultConnectViolations->getIdViolation() ? 'selected' : ''; }?> value="<?php echo $violationModels->getIdViolation(); ?>"><?php echo $violationModels->getNameViolations() . ' ('.$violationModels->getPriceViolations().') ₽'; ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>
