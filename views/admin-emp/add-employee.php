<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\EmployeeEditForm;
use app\models\Department;

$field_counter = 0;
?>
<div>
    <?php $form = ActiveForm::begin([

    ]) ?>
    <div class="col-5"><?= $form->field($edit_form, 'emp_name')->textInput() ?></div>
    <?= $form->field($edit_form, 'dep_name')->hiddenInput(['id'=>'dep_name'])->label('') ?>
    <div id="dep_container">
            <div class="row">
                <div class="col-5 ml-3" id="dep_select">
                    <?= $form->field($edit_form, 'fake')->dropDownList(
                        ArrayHelper::map(Department::find()->all(), 'dep_id', 'dep_name'),
                        ['id' => 'each_dep', 'name' => "dep" . $field_counter])->label(''); ?>
                    <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
                </div>
                <div class="col-2 mt-4">
                    <?= Html::Button('-', ['class' => 'btn btn-danger', 'id' => 'subtract', 'onclick' => 'delete_row(this)']); ?>
                </div>
            </div>
            <?php $field_counter++; ?>
    </div>
    <div class="col-5 text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']); ?>
        <?= Html::Button('+', ['class' => 'btn btn-success ml-5', 'id' => 'new']); ?>

    </div>
    <?php ActiveForm::end() ?>

