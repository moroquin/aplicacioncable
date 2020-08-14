<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cobros */

$this->title = 'Update Cobros: ' . $model->idcobro;
$this->params['breadcrumbs'][] = ['label' => 'Cobros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcobro, 'url' => ['view', 'id' => $model->idcobro]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cobros-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
          'model' => $model,
          'serviciocliente' => $serviciocliente,
          'cobropormes' => $cobropormes,
    ]) ?>

</div>
