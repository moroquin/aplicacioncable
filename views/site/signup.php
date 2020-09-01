<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = 'Registrar Empleado';
?>
<div class="site-signup">
    <div class="panel panel-primary">
        <div class="panel-heading">

            <h1>Registrar Usuario del Empleado</h1>
        </div>    
        <div class="panel-body">
        <div class="row">
        <div class="col-lg-5">
 
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
 
        </div>
    </div>
        </div>
    </div>
    <p>Llene los siguientes campos:</p>
    
</div>