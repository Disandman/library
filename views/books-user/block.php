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
    <h3>Для разблокировки необходимо обратится к сотруднику библиотеки</h3>
    <div class="card">
        <?php if (!empty($lost)) : ?>
            <h6>Потерянные книги: </h6>
            <?php
            foreach ($booksModel->getLostBooksUser()[0] as $books) {
                echo $books;
            }
            $sumBooks = $booksModel->getLostBooksUser()[1];//сумма потерянных книг
            ?>
            <hr>
        <?php else:{//если потерянных книг не найдено, но применено нарушение
            $sumBooks = 0;
        }
        endif;
        ?>
        <?php if (!empty($resultConnectViolation)) : ?>
            <h6>Нарушения:</h6>
            <?php
            foreach ($booksModel->getViolationUser()[0] as $violation) {
                echo $violation;
            }
            $sumViolation = $booksModel->getViolationUser()[1];//сумма нарушений
            ?>
            <hr>
        <?php else:{//если нарушений не найдено, но есть потерянные книги
            $sumViolation = 0;
        }
        endif;
        ?>
        <h5>Сумма для компенсации нарушений: <?php echo ($sumBooks + $sumViolation) . ' ₽' ?></h5>
    </div>
</div>

