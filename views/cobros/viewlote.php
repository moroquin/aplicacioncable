<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Cobros */

$this->title = "Cobro por zona ". $lote->zona . ". Día: ". $lote->fecha;
$this->params['breadcrumbs'][] = ['label' => 'Cobros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cobros-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  'idcobro',
            'contrasenya',
            'factura',
            //'idempleado',
            'fecha',
            'totalporcobrar',
            'mesesporcobrar',
            'totalcobrado',
            'mesespagados',



           
            
            'zona',
            'anyomes',
           // 'lote_idlote',
        ],
    ]) ?>
  <?php Pjax::end(); ?>
</div>
