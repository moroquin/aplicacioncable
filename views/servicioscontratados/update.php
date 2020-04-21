<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Servicioscontratados */

$this->title = 'Update Servicioscontratados: ' . $model->idservicioscontratados;
$this->params['breadcrumbs'][] = ['label' => 'Servicioscontratados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idservicioscontratados, 'url' => ['view', 'id' => $model->idservicioscontratados]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicioscontratados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
