<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CobrosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cobros-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idcobro') ?>

    <?= $form->field($model, 'numerofactura') ?>

    <?= $form->field($model, 'idempleado') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'idservicioscontratados') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'factura') ?>

    <?php // echo $form->field($model, 'contrasenya') ?>

    <?php // echo $form->field($model, 'zona') ?>

    <?php // echo $form->field($model, 'anyomes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
