<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Servicios */

$this->title = 'Creación de un servicio nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'serviciosDisponibles' => $serviciosDisponibles,
    ]) ?>

</div>
