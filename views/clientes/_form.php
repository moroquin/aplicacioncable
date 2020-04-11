<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idcliente')->textInput() ?>

    <?= $form->field($model, 'correlativo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primernombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundonombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primerapelldio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundoapellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dpi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencias')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'telefono1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nit')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
