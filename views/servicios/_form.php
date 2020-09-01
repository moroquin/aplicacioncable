<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Servicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicios-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-primary">

        <div class="panel-heading">Información General</div>

        <div class="panel-body">

            <div class="col-xs-4">
                <?= $form->field($model, 'tiposervicio')->dropDownList($serviciosDisponibles, ['prompt' => 'Servicio prestado: ']) ?>
            </div>

            <div class="col-xs-6"><?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?></div>

            <div class="col-xs-2"><?= $form->field($model, 'tarifa')->textInput() ?></div>

            <div class="col-xs-12"><?= $form->field($model, 'descripcion')->textarea(['rows' => 2]) ?></div>


            <div class="col-xs-6">
                <?php if (!(empty($model->idservicio))) { ?>
                    <p class="lead text-justify">Este servicio esta <strong><?= ($model->disponible) ? 'Activo' : 'De Baja' ?> </strong>. </p>
                <?php } ?>
            </div>

        </div>

        <div class="panel-body">
            <div class="col-xs-12"><?= Html::submitButton(!(empty($model->idservicio)) ? 'Actualizar Información' : 'Guardar nuevo servicio', ['class' => 'btn btn-block btn-success']) ?></div>
            <div class="col-xs-12" style="<?= ((empty($model->idservicio))) ? 'display: none' : 'display: block' ?>"><?= Html::a(Yii::t('app', (($model->disponible) ? 'Dar de <strong>baja</strong> el servicio' : 'Dar de <strong>alta</strong> al servicio')), ['servicios/updatealta', 'id' => $model->idservicio], [
                                                                                                                            'class' => ($model->disponible) ? 'btn btn-block btn-danger' : 'btn btn-block btn-warning',
                                                                                                                            'data' => [
                                                                                                                                'confirm' => '¿Está seguro de querer cambiar el estado de este curso?',
                                                                                                                                'method' => 'post',
                                                                                                                            ]
                                                                                                                        ]) ?></div>
        </div>
    </div>
    <div class="panel panel-warning">

        <div class="panel-heading">Acerca del estado del servicio</div>
        <div class="panel-body">
            <div class="col-xs-12">
                <p class="lead text-justify"><strong>Servicio Activo:</strong> implica que los clientes pueden adquirir este servicio. </p>
            </div>
            <div class="col-xs-12">
                <p class="lead text-justify"><strong>Baja del servicio:</strong> implica que los clientes no podrán adquirir este contrato, sin embargo los contratos existentes siguen activos. </p>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>