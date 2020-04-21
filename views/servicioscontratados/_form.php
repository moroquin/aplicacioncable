<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Servicioscontratados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicioscontratados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mesesnopagados')->textInput() ?>

    <?= $form->field($model, 'subtotal')->textInput() ?>

    <?= $form->field($model, 'idcliente')->textInput() ?>

    <?= $form->field($model, 'idservicio')->textInput() ?>

    <?= $form->field($model, 'contratonumero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cobropactado')->textInput() ?>

    <?= $form->field($model, 'duracioncontrato')->textInput() ?>

    <?= $form->field($model, 'fechainicio')->textInput() ?>

    <?= $form->field($model, 'nombreestado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'corte')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
