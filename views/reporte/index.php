<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reportes generales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-index">

    <h1><?= Html::encode($this->title) ?></h1>








    <?= Html::beginForm('general', 'post', ['target' => '_blank']) ?>
    <div class="panel panel-info">


        <div class="panel-heading">Creación de reportes</div>
        <div class="panel-body">



            <div class="col-xs-6">
                <div class="row">
                    <label for="fecha">Fecha reporte:</label>
                    <?= DatePicker::widget([
                        'name' => 'fecha',
                        'id' => 'fecha',
                        'value' => date('Y-m-d', strtotime('+0 days')),
                        'options' => ['placeholder' => 'Seleccione la fecha para los reportes'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true,
                            'autoclose' => true,
                        ]
                    ]) ?>
                </div>

                <div class="row">
                <label for="zona">Zona:</label>

                    <?= Select2::widget([
                        'name' => 'zona',
                        'id' => 'zona',
                        'value' => '',
                        'data' => $zonas,
                        'options' => ['multiple' => false, 'placeholder' => 'Seleccione la zona']
                    ])
                    ?>
                </div>


                <div class="row">
                <label for="servicio">Tipo de servicio:</label>

                    <?= Select2::widget([
                        'name' => 'servicio',
                        'id' => 'servicio',
                        'value' => '',
                        'data' => $servicios,
                        'options' => ['multiple' => false, 'placeholder' => 'Seleccione el servicio']
                    ])
                    ?>
                </div>



            </div>
            <div class="col-xs-1">
            </div>
            <div class="col-xs-5">


                <div class="row"><?= Html::submitButton('Ingresos por día', ['class' => 'btn btn-primary btn-block', 'name' => 'ingresospordia', 'value' => 'ingresospordia']) ?></div>
                <p></p>
                <div class="row"><?= Html::submitButton('Ingresos por mes', ['class' => 'btn btn-primary btn-block', 'name' => 'ingresopormes', 'value' => 'ingresopormes']) ?></div>
                <p></p>
                <div class="row"><?= Html::submitButton('Contratos activos del mes', ['class' => 'btn btn-info btn-block', 'name' => 'activosmes', 'value' => 'activosmes']) ?></div>
                <p></p>
                <div class="row"><?= Html::submitButton('Morosos del mes actual', ['class' => 'btn btn-warning btn-block', 'name' => 'morososmes', 'value' => 'morososmes']) ?></div>
                <p></p>
                <div class="row"><?= Html::submitButton('Servicios de baja del mes actual', ['class' => 'btn btn-warning btn-block', 'name' => 'debaja', 'value' => 'debaja']) ?></div>


            </div>


        </div>
        <div class="panel-heading">Importante</div>
        <div class="panel-body">
            <p>Si no selecciona zona implica que hará el reporte de todas las zonas. </p>
            <p>Si no selecciona tipo de servicio implica que hará el reporte de todos los tipos de servicio. </p>
        </div>
    </div>

    <?= Html::endForm() ?>

</div>