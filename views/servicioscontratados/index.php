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




    <div class="panel ">
        <div class="col-xs-12">
            <?= Html::a('Nuevo contrato', ['create'], ['class' => 'btn btn-block btn-success']) ?>
        </div>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'primernombre',
                'value' => 'clientes.primernombre',
            ],

            [
                'attribute' => 'segundonombre',
                'value' => 'clientes.segundonombre',
            ],

            [
                'attribute' => 'primerapelldio',
                'value' => 'clientes.primerapelldio',
            ],

            [
                'attribute' => 'segundoapellido',
                'value' => 'clientes.segundoapellido',
            ],

            [
                'attribute' => 'correlativo',
                'value' => 'clientes.correlativo',
            ],

            //'clientes.primernombre',
            'mesesnopagados',
            //'subtotal',
            //'idcliente',
            //'idservicio',
            'contratonumero',
            //'cobropactado',
            //'duracioncontrato',
            'fechainicio',
            'nombreestado',
            //'idservicioscontratados',
            //'corte',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>



    <?php Pjax::end(); ?>





</div>