<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Cobros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cobros-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-primary">
        <div class="panel-heading">Cliente:</div>
        <div class="panel-body">


            <div class="col-xs-12">
                <?= $form->field($model, 'idservicioscontratados')
                    ->widget(Select2::classname(), [
                        'data' =>  $serviciocliente,
                        'options' => ['tag' => true, 'placeholder' => 'Seleccione el cliente para asigar el cobro'],
                        'pluginOptions' => ['allowClear' => true,],


                    ]) ?>
            </div>

            <div class="col-xs-12">

                <?= $form->field($model, 'zona')->textInput(['readonly' => true]) ?>
            </div>
        </div>

        <div class="panel-heading">Cobro:</div>
        <div class="panel-body">

            <div class="col-xs-6">
                <?= $form->field($model, 'anyomes')->textInput(['readonly' => true]) ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'fecha')->textInput(['readonly' => true]) ?>
            </div>

            <div class="col-xs-6"><?= $form->field($model, 'mesesporcobrar')->textInput(['readonly' => true]) ?></div>
            <div class="col-xs-6"><?= $form->field($model, 'totalporcobrar')->textInput(['readonly' => true]) ?></div>
            <div class="col-xs-6">
                <?= $form->field($model, 'mesespagados')
                    ->widget(Select2::classname(), [
                        'data' =>  [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
                        'options' => ['tag' => true, 'placeholder' => 'Seleccione el cliente para asigar el cobro'],
                        'pluginOptions' => ['allowClear' => true,],

                    ]) ?>
            </div>


            <div class="col-xs-6"><?= $form->field($model, 'totalcobrado')->textInput(['readonly' => true]) ?></div>

            <div class="col-xs-6"><?= $form->field($model, 'factura')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-6"><?= $form->field($model, 'contrasenya')->textInput(['maxlength' => true]) ?></div>




        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Guardar cobro ', ['class' => 'btn btn-block btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS

  JS;
$this->registerJs($script);
?>
