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
            <div class="table-responsive">
                <table class="table  table-bordered table-hover table-condensed">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Cliente y servicio</th>
                            <th scope="col">Meses P/Pagar</th>
                            <th scope="col">Cobro P/Mes</th>
                            <th scope="col">Meses pagados</th>
                            <th scope="col">Monto Pagado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lote as $cobro) { ?>
                            <tr>
                                <th scope="row"><?= $serviciocliente[$cobro->idservicioscontratados]['nombre'] ?></th>
                                <th><?= $serviciocliente[$cobro->idservicioscontratados]['mesesporpagar'] ?></th>
                                <th>
                                    <div id="cobropactado<?= $cobro->idservicioscontratados ?>"><?= $serviciocliente[$cobro->idservicioscontratados]['cobropactado'] ?></div>
                                </th>
                                <th><?= $form->field($cobro, 'mesespagados')
                                        ->hiddenInput(['id' => 'mesespagados' . $cobro->idservicioscontratados])
                                        ->widget(Select2::classname(), [
                                            'data' =>  [0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16],
                                            'options' => ['tag' => true, 'id' => 'mesespagados' . $cobro->idservicioscontratados],
                                            'pluginOptions' => ['allowClear' => false,],

                                            'pluginEvents' => [
                                                "select2:select" => "function(value) { 
                                                    var montocobrado =  $('#montocobrado" . $cobro->idservicioscontratados . "');
                                                    var total = $('#total')[0].innerText - montocobrado.val();
                                                    montocobrado.val($('#mesespagados" . $cobro->idservicioscontratados . "').val() * ($('#cobropactado" . $cobro->idservicioscontratados . "')[0].innerText));
                                                    $('#total').html(parseInt(total) + parseInt(montocobrado.val()));
                                                }",
                                            ]

                                        ])->label(false) ?></th>
                                <th><?= $form->field($cobro, 'totalcobrado', ['inputOptions' => ['id' => 'montocobrado' . $cobro->idservicioscontratados]])
                                        ->textInput(['readonly' => true])->label(false) ?></th>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total por cobrar</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <div id="total">0</div>
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