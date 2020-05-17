<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Servicioscontratados */

$this->title = 'Create Servicioscontratados';
$this->params['breadcrumbs'][] = ['label' => 'Servicioscontratados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicioscontratados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
      'modelservicios' => $modelservicios,
      'servicios' => $servicios,
      'clientes' => $clientes,
      'tarifas' => $tarifas,
      'pendientes' => $pendientes,

      'model' => $model,
      'zonas' => $zonas,
      'zona' => $zona,

      'estados' => $estados,
    ]) ?>

</div>
