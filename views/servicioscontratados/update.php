<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Servicioscontratados */

$this->title = 'Update Servicioscontratados: ' . $modelservicios->idservicioscontratados;
$this->params['breadcrumbs'][] = ['label' => 'Servicioscontratados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelservicios->idservicioscontratados, 'url' => ['view', 'id' => $modelservicios->idservicioscontratados]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicioscontratados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
     'modelservicios' => $modelservicios,
     'servicios' => $servicios,
     'clientes' => $clientes,
     'tarifas' => $tarifas,


     'model' => $model,
     'zonas' => $zonas,
     'zona' => $zona,

     'estados' => $estados,
    ]) ?>

</div>
