<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ServicioscontratadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Servicioscontratados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicioscontratados-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Servicioscontratados', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'mesesnopagados',
            'subtotal',
            'idcliente',
            'idservicio',
            'contratonumero',
            //'cobropactado',
            //'duracioncontrato',
            //'fechainicio',
            //'nombreestado',
            //'idservicioscontratados',
            //'corte',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
