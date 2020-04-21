<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServicioscontratadosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicioscontratados-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'mesesnopagados') ?>

    <?= $form->field($model, 'subtotal') ?>

    <?= $form->field($model, 'idcliente') ?>

    <?= $form->field($model, 'idservicio') ?>

    <?= $form->field($model, 'contratonumero') ?>

    <?php // echo $form->field($model, 'cobropactado') ?>

    <?php // echo $form->field($model, 'duracioncontrato') ?>

    <?php // echo $form->field($model, 'fechainicio') ?>

    <?php // echo $form->field($model, 'nombreestado') ?>

    <?php // echo $form->field($model, 'idservicioscontratados') ?>

    <?php // echo $form->field($model, 'corte') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
