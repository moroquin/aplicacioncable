<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Servicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicios-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">

        <div class="col-xs-4">
            <?= $form->field($model, 'tiposervicio')->dropDownList($serviciosDisponibles, ['prompt' => 'Servicio prestado: ']) ?>
        </div>

        <div class="col-xs-6"><?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?></div>

        <div class="col-xs-2"><?= $form->field($model, 'tarifa')->textInput() ?></div>

    </div>

    <div class="row">
        <div class="col-xs-12"><?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?> </div>
    </div>

    <div class="row">

        <div class="col-xs-6">
            <?php if (!(empty($model->idservicio))) { ?>
                <p class="lead text-justify">Este servicio esta <strong><?= ($model->disponible) ? 'Activo' : 'De Baja' ?> </strong>. </p>
            <?php } ?>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <?= Html::submitButton(!(empty($model->idservicio)) ? 'Actualizar Información' : 'Guardar nuevo servicio', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>



    <?php if (!(empty($model->idservicio))) { ?>
        <div class="panel-footer">
            <div class="form-group">
                <center><?= Html::a(Yii::t('app', (($model->disponible) ? 'Dar de <strong>baja</strong> el servicio' : 'Dar de <strong>alta</strong> al servicio')), ['servicios/updatealta', 'id' => $model->idservicio], ['class' => ($model->disponible) ? 'btn btn-danger' : 'btn btn-warning']) ?></center>
                <p class="lead text-justify"><strong>Servicio Activo:</strong> implica que los clientes pueden adquirir este servicio. </p>
                <p class="lead text-justify"><strong>Baja del servicio:</strong> implica que los clientes no podrán adquirir este contrato, sin embargo los contratos existentes siguen activos. </p>
            </div>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>



</div>