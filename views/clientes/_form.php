<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="clientes-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-primary">

        <div class="panel-heading">Identificación</div>
        <div class="panel-body">
            <div class="col-xs-4"><?= $form->field($model, 'correlativo')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-4"><?= $form->field($model, 'dpi')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-4"><?= $form->field($model, 'nit')->textInput(['maxlength' => true]) ?></div>
        </div>

        <div class="panel-heading">Nombres y apellidos</div>
        <div class="panel-body">
            <div class="col-xs-3"><?= $form->field($model, 'primernombre')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-3"><?= $form->field($model, 'segundonombre')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-3"><?= $form->field($model, 'primerapelldio')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-3"><?= $form->field($model, 'segundoapellido')->textInput(['maxlength' => true]) ?></div>
        </div>


        <div class="panel-heading">Contacto</div>
        <div class="panel-body">
            <div class="col-xs-12"><?= $form->field($model, 'direccion')->textarea(['rows' => 2]) ?></div>
            <div class="col-xs-4"><?= $form->field($model, 'nombrezona')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-4"><?= $form->field($model, 'telefono1')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-4"><?= $form->field($model, 'telefono2')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-12"><?= $form->field($model, 'referencias')->textarea(['rows' => 6]) ?></div>
        </div>

        <div class="panel-body">
            <div class="col-xs-12"><?= Html::submitButton(!(empty($model->idcliente)) ? 'Actualizar Información' : 'Guardar nuevo Cliente', ['class' => 'btn btn-block btn-success']) ?></div>
        </div>


    </div>
    <?php ActiveForm::end(); ?>

</div>