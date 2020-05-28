<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cobros */

$this->title = 'Cobro por Zona';
$this->params['breadcrumbs'][] = ['label' => 'Cobros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cobros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_lote', [
        'model' => $model,
        'serviciocliente' => $serviciocliente,
        'cobropormes' => $cobropormes,
    ]) ?>

</div>
