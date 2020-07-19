<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Empleados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empleados-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>
                Actualizar password para el empleado: <?= $model2->nombre.' '.$model2->apellido ?>
            </h1>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'password')->passwordInput()?>
        </div>
       


        <div class="panel-footer">

            <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Actualizar'), ['class' => 'btn btn-success']) ?>
                    <?= Html::a(Yii::t('app', 'Cancelar'), ['empleados/view', 'id' => $model2->idempleado], ['class' => 'btn btn-danger'])?>
            </div>
        </div>    
    </div> 
    
    <?php ActiveForm::end(); ?>

</div>