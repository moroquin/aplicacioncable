<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Empleados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empleados-form">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <H1>Actualizar Informacion Empleado: <?=$model->nombre.' '.$model->apellido?></H1>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
        <!--
            <?= $form->field($model, 'puestos_idpuestos')->textInput() ?>
        -->
            <?= $form->field($model, 'puestos_idpuestos')->widget(Select2::classname(),[
                'data' => $puestos,
                'options'=>['placeholder'=>'Seleccione un puesto'],
                'pluginOptions'=>['allowClear=>true'],
            ]) ?>

        </div>
        <div class="panel-footer">

            
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Siguiente'), ['class' => 'btn btn-success']) ?>
                    <?= Html::a(Yii::t('app', 'Cancelar'), ['view', 'id' => $model->idempleado], ['class' => 'btn btn-danger'])?>
                </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
