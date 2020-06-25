<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Lotes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cobros-form">



    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-primary">
        <div class="panel-heading">Cliente:</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table  table-bordered table-hover table-condensed">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Cliente y servicio</th>
                            <th scope="col">Meses P/Pagar</th>
                            <th scope="col">Cobro P/Mes</th>
                            <th scope="col">Factura</th>
                            <th scope="col">Contraseña</th>
                            <th scope="col">Meses pagados</th>
                            <th scope="col">Monto Pagado</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                     
                        <?php foreach ($model->cobros as $key => $cobro) { ?>
                            <tr>
                                <th scope="row"><?= $serviciocliente[$cobro->idservicioscontratados]['nombre'] ?></th>
                                <th><?= $serviciocliente[$cobro->idservicioscontratados]['mesesporpagar'] ?> meses:  <?= $cobro->mesesporcobrardet ?></th>
                                <th>
                                    <div id="cobropactado<?= $cobro->idservicioscontratados ?>"><?= $serviciocliente[$cobro->idservicioscontratados]['cobropactado'] ?></div>
                                </th>
                                <th><?= $form->field($cobro, 'contrasenya')
                                        ->textInput([ 'id' => "Cobros{$key}_contrasenya", 'name' => "Cobros[$key][contrasenya]"])->label(false) ?></th>
                                <th><?= $form->field($cobro, 'factura')
                                        ->textInput([ 'id' => "Cobros{$key}_factura", 'name' => "Cobros[$key][factura]"])->label(false) ?></th>
                                <th><?= $form->field($cobro, 'mesespagados')

                                        ->widget(Select2::classname(), [
                                            'data' =>  [0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16],
                                            'options' => ['tag' => true, 'id' => "Cobros{$key}_mesespagados", 'name' => "Cobros[$key][mesespagados]"],
                                            'pluginOptions' => ['allowClear' => false,],

                                            'pluginEvents' => [
                                                "select2:select" => "function(value) { 
                                                    var montocobrado =  $('#Cobros{$key}_totalcobrado');
                                                    var total = $('#lote-totalcobrado').val() - montocobrado.val();
                                                  
                                                    montocobrado.val($('#Cobros{$key}_mesespagados').val() * ($('#cobropactado" . $cobro->idservicioscontratados . "')[0].innerText));
                                                    $('#lote-totalcobrado').val(parseInt(total) + parseInt(montocobrado.val()));
                                                }",
                                            ]

                                        ])->label(false) ?></th>
                                <th><?= $form->field($cobro, 'totalcobrado')
                                        ->textInput(['readonly' => false, 'id' => "Cobros{$key}_totalcobrado", 'name' => "Cobros[$key][totalcobrado]"
                                        
                                        
                                        ])->label(false) ?></th>
                                
                            </tr>
                        <?php } ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total por cobrar</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            
                            <th></th>
                            <th></th>
                            <th>
                                <?= $form->field($model->lote, 'totalcobrado')->textInput(['readonly' => true])->label(false) ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Guardar cobros ', ['class' => 'btn btn-block btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS

  JS;
$this->registerJs($script);
?>