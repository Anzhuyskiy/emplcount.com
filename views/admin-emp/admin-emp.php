<?php
use app\models\Department;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
?>
<table class="table">
    <tr>
        <th>Employee name </th>
        <th>Department names</th>
        <th><select id="filter" class="custom-select">
                <option selected>Filter</option>
                <?php foreach ($all_deps as $each_dep):?>
            <option><?= $each_dep->dep_name?></option>
            <?php endforeach;?>
            </select></th>
    </tr>
    <?php foreach ($empl_list as $empl=>$val) :?>
        <tr>
            <?= "<td>" . $val['emp_name'] . "</td><td>" .$val['dep_names'] .  "</td>" ?>
            <td>
                <a href="<?= '/admin-emp/edit?id='.$val['emp_id'] ?>" class="btn btn-secondary"> edit </a>
                <a href="<?= '/admin-emp/delete?id='.$val['emp_id'] ?>" class="btn btn-danger ml-2"> delete </a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<div><a href="/admin-emp/add-employee">Add Emloyee</a></div>
<?php
$this->registerJs('
    $("#filter").on("change",function () {
          $(".table tr td:nth-child(2)").each(function(){
                console.log($(this).text());
                $(this).parents("tr").show();
                if(!$(this).text().includes($("#filter").val())){
                    $(this).parents("tr").hide()
                }
                if($("#filter").val() == "Filter"){
                    $(this).parents("tr").show();
                }
          })
          
                
    })
');
?>
