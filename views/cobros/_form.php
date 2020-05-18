<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cobros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cobros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numerofactura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idempleado')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'idservicioscontratados')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'factura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contrasenya')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anyomes')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
