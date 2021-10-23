<?php
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form =ActiveForm::begin([
        'id' => 'login-form',
        'action'=>'/auth/login',
        'layout' => 'horizontal',
        'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
    ],]);?>

<?=$form->field($users,'email')->textInput()?>
<?=$form->field($users,'password')->passwordInput()?>
<div class="form-group">
    <div class="offset-lg-1 col-lg-11">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>
<?php ActiveForm::end();?>

