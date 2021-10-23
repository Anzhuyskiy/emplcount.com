<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="text-center bg-transparent">
        <h1 class="display-4">Welcom to you account of employees app</h1>
        <p class="lead">On this Page you can see the requirements for the app:</p>
    </div>
    <div class="body-content">
        <ul>
            <li>Должно поддерживаться две сущности: пользователь (сотрудник) и отдел.</li>
            <li>С помощью интерфейса можно добавить как нового сотрудника, так и новый отдел.</li>
            <li>Можно удалить сотрудника или отдел.</li>
            <li>Сотруднику или отделу можно сменить имя и название соответственно.</li>
            <li>Сотруднику можно сменить отдел на любой другой.</li>
            <li>Пользователь должен всегда состоять как минимум в одном отделе (Их может быть несколько у любого сотрудника)</li>
            <li>При удалении отдела сотрудники автоматически из него удаляются. (Примечание: Нельзя удалить отдел, если сотрудник состоит только в нем)</li>
            <li>Нужна форма, где можно посмотреть сотрудников по отделам (Фильтра по одному отделу достаточно)</li>
            <li>Нужна форма, где можно посмотреть в каких отделах состоит конкретный сотрудник</li>
        </ul>
    </div>
    <p class="lead">For begin you need to switch to login page and fill the form using one of the following accounts:</p>
    <table class="col-1 table">
        <tr>
            <th>Role</th>
            <th>Login</th>
            <th>Password</th>
        </tr>
        <tr>
            <td>Admin</td>
            <td>admin@mail.ru</td>
            <td>111</td>
        </tr>
    </table>
</div>
