<?php
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
AppAsset::register($this);
$href_style = 'btn btn-danger disabled';
?>

<div class="row">
    <?php $form = ActiveForm::begin([
        'id'=>'add_form',
        'action'=>'/admin-dep/add-new'
    ])?>
    <div class="col-10"><?= \yii\helpers\Html::submitButton('Add a new department',['class'=>'btn btn-primary'])?></div>
    <div class="col-10">
        <?= $form->field($dep,'dep_name')->textInput(['placeholder'=>'department name'])->label('')?>
    </div>
    <?php ActiveForm::end()?>
    <div class="col-4 ml-5" id="edit_form">
        <form action='/admin-dep/edit' method='POST' id="edit_form" style="display: none">
            <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
            <label>Please type a new department name</label>
            <input type="text" id="dep_name" name="dep_name" placeholder="">
            <input type="hidden" id="dep_id" name="id">
            <input type="submit" id="edit_btn" class="btn btn-success"  value="save">
        </form>
    </div>
</div>

<table class="table mt-5">
    <tr>
        <th>Department</th>
        <th>Employee count</th>
        <th>Show By</th>
        <th></th>
    </tr>

    <?php foreach ($deps as $key=>$val):?>
    <?php $val['employee_count'] == 0? $href_style = 'btn btn-danger disabled':$href_style="btn btn-danger" ?>
        <?php $form= ActiveForm::begin() ?>
        <?= "<tr>"
            ."<td id=".$val['dep_id'].">".$val['dep_name']."</td>"
            ."<td>".$val['employee_count']."</td>"
            ."<td><a class='btn btn-secondary' id='Edit' title=".$val['dep_id'].">Edit</a>
                <a class='btn btn-danger' id='Delete' title=".$val['dep_id']."> Delete</a></td>"
        ?>
    <?php ActiveForm::end()?>
    <?php endforeach;?>
    <?php foreach ($deps_zero as $key=>$val): ?>
        <?= "<tr>"
        ."<td id=".$val['dep_id'].">".$val['dep_name']."</td>"
        ."<td>0</td>"
        ."<td><a class='btn btn-secondary' id='Edit' title=".$val['dep_id'].">Edit</a>
                <a class='btn btn-danger'  id='Delete' title=".$val['dep_id']."> Delete</a></td>".
        "</tr>"?>
    <?php endforeach;?>
</table>


<?php
$this->registerJs('
    $("a#Edit").on("click",function () {
             console.log();
             if(($("input#dep_name").is(":visible")) === false){
//             $("form#edit_form").attr("action","/admin-dep/edit?id="+this.title)
                $("form#edit_form").show()
                $("input#dep_id").val(this.title);
                $("#dep_name").attr("placeholder",$("td#"+this.title).text())
               
             }else{
                $("form#edit_form").hide()
             }
             })
');
$this->registerJs('
$("a#Delete").on("click",function () {
            $.ajax({
                url: "/admin-dep/delete",
                type: "get",
                data: "id="+this.title,
                success: function(data){
                    alert(data)
                    location.reload()
                },
                error: function () {
                    alert("ERROR. Server Error. Contact dev-service")
                }
            });
        });
');
//"'.\yii\helpers\Url::toRoute(['admin-dep/edit','id'=>'$(this).attr("title")']).'"
?>