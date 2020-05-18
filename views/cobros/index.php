<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CobrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cobros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cobros-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cobros', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= ($mesanyo)? Html::a('Generar cobros del mes'.$mesanyo, ['cobrosmes'], ['class' => 'btn btn-success']): "" ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idcobro',
            'numerofactura',
            //'idempleado',
            //'fecha',
            //
            //'idservicioscontratados',
            //'tipo',
            //'factura',
            'contrasenya',
            'zona',
            'anyomes',
            'total',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
