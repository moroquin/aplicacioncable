<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $modelservicios app\models\Servicioscontratados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicioscontratados-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-success">

        <div class="panel-heading">Datos del cliente</div>
        <div class="panel-body">

            <div class="col-xs-12">
                <?= $form->field($modelservicios, 'idcliente')
                    ->widget(Select2::classname(), [
                        'data' =>  $clientes,
                        'options' => ['tag' => true, 'placeholder' => 'Seleccione el cliente que contratará el servicio'],
                        'pluginOptions' => ['allowClear' => true,],

                    ]) ?>
            </div>

        </div>

        <div id="clientenuevo" style="display: none">

            <!-- ****** cambiar aca por el form de ingreso de usuario  ********* -->

            <div class="panel panel-success">

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
                    <div class="col-xs-12"><?= $form->field($model, 'direccion')->textarea(['rows' => 1]) ?></div>
                    <div class="col-xs-4"><?= $form->field($model, 'telefono1')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-xs-4"><?= $form->field($model, 'telefono2')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-xs-12"><?= $form->field($model, 'referencias')->textarea(['rows' => 1]) ?></div>
                </div>

                <div class="panel-heading">Agrupación para cobradores</div>
                <div class="panel-body">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'nombrezona')
                            ->widget(Select2::classname(), [
                                'data' =>  $zonas,
                                'options' => ['tag' => true, 'placeholder' => 'Seleccione la zona para agrupar al cliente'],
                                'pluginOptions' => ['allowClear' => true,],

                            ]) ?>
                    </div>

                    <div class="col-xs-6" id="agregarzona" style="display: none">
                        <?= $form->field($zona, 'nombrezona')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>

            <!-- ****** cambiar aca por el form de ingreso de usuario  ********* -->
        </div>

    </div>


    <div class="panel panel-primary">


        <div class="panel-heading">Datos del contrato</div>
        <div class="panel-body">
            <div class="col-xs-12">
                <?= $form->field($modelservicios, 'idservicio')
                    ->widget(Select2::classname(), [
                        'data' =>  $servicios,
                        'options' => ['tag' => true, 'placeholder' => 'Seleccione el servicio que se contratará.'],
                        'pluginOptions' => ['allowClear' => true,],

                    ]) ?>
            </div>
            

            <div class="col-xs-4">
                <?= $form->field($modelservicios, 'contratonumero')->textInput(['maxlength' => true]) ?>
            </div>


            <div class="col-xs-4">
                <?= $form->field($modelservicios, 'duracioncontrato')->textInput(['type' => 'number']) ?>
            </div>

            <div class="col-xs-4">
                <?= $form->field($modelservicios, 'fechainicio')
                    ->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Ingrese fecha inicio'],
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]) ?>
            </div>

            <div class="col-xs-12">
                <?= $form->field($modelservicios, 'corte')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-block btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php
$script = <<< JS
   
    const clientenew = document.querySelector('#clientenuevo')

    $('#servicioscontratados-idcliente').on('change', function(){
        if ( this.value == '1') {
            
            clientenew.style.display =  "block";      
            }
            else {
                nombrezona.value = 'Escribe aca . . .';
                clientenew.style.display =  "none";
            }
        });



        const nombrezona = document.querySelector('#zona-nombrezona');
    const divnombrezona = document.querySelector('#agregarzona');
    
  $('#clientes-nombrezona').on('change', function() {
    if ( this.value == '0') {
       nombrezona.value = '';
       divnombrezona.style.display =  "block";      
    }
    else {
        nombrezona.value = 'Escribe aca . . .';
        divnombrezona.style.display =  "none";
    }
  });
      
  JS;
$this->registerJs($script);
?>