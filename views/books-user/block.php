<?php

use App\core\Breadcrumb;

Breadcrumb::add_current('', 'Мои книги');
?>

<div class="bg-light">
    <?php echo Breadcrumb::out(); ?>
</div>
<br>
<div class="error-main">
    <div class="error-heading" style="font-size: 84px ">Абонемент заблокирован</div>
    <h5>Для разблокировки необходимо обратится к сотруднику библиотеки</h5>
</div>

