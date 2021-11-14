<div style="font-size: 16px">
<div class="list-group text-center">
            <h1>Приложение «Библиотека ВУЗа»:</h1>
            <hr>
            <p class="lead">Необходимо написать приложение для учета и контроля библиотечного фонда ВУЗа.</p>
            <hr>
            <h3>Требования к функционалу:</h3>
</div>
            <div class="text-left">
            <ul class="list-group list-group-flush">
                <li class="list-group-item list-group-item-action">&#9675; Механизм авторизации пользователя;</li>
                <li class="list-group-item list-group-item-action">&#9675; Механизмы добавления в базу данных:</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	новых читателей (каждый читатель имеет принадлежность «студент» или «преподаватель»);</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	новых книг (название, автор, год издания);</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	справочных данных (подразделение, курс, группа).</li>
                <li class="list-group-item list-group-item-action">&#9675; Механизм присваивания каждому читателю уникальных данных (для преподавателей):</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	подразделение.</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	научное звание.</li>
                <li class="list-group-item list-group-item-action">&#9675; Механизм присваивания каждому читателю уникальных данных (для студента):</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	факультет;</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	курс;</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	группа.</li>
                <li class="list-group-item list-group-item-action">&#9675; Механизм разделения читателей по читальным залам (у каждого читального зале есть разделение по типу читателя).</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	получать информацию об имеющихся книгах у читателя, его задолженностях;</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	получать информацию о книгах, находящихся в каждом читальном зале (наличие, выдаче и утере).</li>
                <li class="list-group-item list-group-item-action">&#9675;	Механизм блокировки пользователя при нарушении пользования библиотекой;</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	временная блокировка пользователя при нарушениях правил пользования библиотекой;</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	автоматическая разблокировка при исчерпании сроков блокировки.</li>
                <li class="list-group-item list-group-item-action">&#9675; Механизм расчета нарушений:</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	расчет при утере книги читателем;</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	расчет других нарушений пользования библиотекой.</li>
                <li class="list-group-item list-group-item-action">&#9675;	Механизм продления читательского билета при переходе на следующий год обучения (в случае отсутствия задолженностей).</li>
            </ul>
            <hr>
            </div>
            <div class="text-center">
            <h3>Дополнительные задачи:</h3>
</div>
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item list-group-item-action">&#9675;	Логирование:</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	входа пользователя системы;</li>
                <li class="list-group-item">&#160;&#160;&#160;&#160;&#8722;	изменения и удаление (пользователей и книг).</li>
            </ul>    
            <hr>
        </div>
    </div>
</div>

<br>

<?php


/** @var void $model */
foreach ($model as $product) {
    echo "Имя:".$product->getName().'<br>';
}


?>
<form action = "/account/update" method = "POST">
    Name: <input type = "text" name = "name" />
    <input type = "submit" />
</form>
<br>
<hr>
<br>
