<?php
use yii\helpers\ArrayHelper;
$href_style = 'btn btn-danger disabled';
?>
<style>
    a.disabled {
        pointer-events: none; /* делаем элемент неактивным для взаимодействия */
        cursor: default; /*  курсор в виде стрелки */
        color: #888;/* цвет текста серый */
    }
</style>
<a href="" class="btn btn-primary">Add a new department</a>
<table class="table mt-5">
    <tr>
        <th>Department</th>
        <th>Employee count</th>
        <th>Show By</th>
        <th></th>
    </tr>

    <?php foreach ($deps as $key=>$val):?>
    <?php $val['employee_count'] == 0? $href_style = 'btn btn-danger disabled':$href_style="btn btn-danger" ?>
    <?= "<tr>"
            ."<td>".$val['dep_name']."</td>"
            ."<td>".$val['employee_count']."</td>"
            ."<td><a class='btn btn-secondary' href=''>Edit</a>
                <a class='btn btn-danger disabled' href=''> Delete</a></td>"
        ?>
    <?php endforeach;?>
    <?php foreach ($deps_zero as $key=>$val): ?>
        <?= "<tr>"
        ."<td>".$val['dep_name']."</td>"
        ."<td>0</td>"
        ."<td><a class='btn btn-secondary' href=''>Edit</a>
                <a class='btn btn-danger' href=''> Delete</a></td>".
        "</tr>"?>
    <?php endforeach;?>
</table>
