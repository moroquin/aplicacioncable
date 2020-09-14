<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ServicioscontratadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listado de contratos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicioscontratados-index">






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
                'attribute' => 'correlativo',
                'value' => 'clientes.correlativo',
            ],

            [
                'attribute' => 'primernombre',
                'value' => 'clientes.primernombre',
            ],


            [
                'attribute' => 'primerapelldio',
                'value' => 'clientes.primerapelldio',
            ],


            

            [
                'attribute' => 'nombreestado',
                'value' => 'nombreestado',
                //'filter' => $estados,
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'nombreestado',
                    $estados,
                    [
                        'class' => 'form-control',
                        'prompt' => 'Select Category'
                    ]
                ),
            ],

            //'clientes.primernombre',
            'mesesnopagados',
            'detmesesporpagar',
            //'subtotal',
            //'idcliente',
            //'idservicio',
            //'contratonumero',
            //'cobropactado',
            //'duracioncontrato',
            //'fechainicio',

            //'idservicioscontratados',
            //'corte',
            'nombrezona',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>



    <?php Pjax::end(); ?>



    <div class="panel panel-primary">
        <div class="panel-body">
            <?= Html::a('Nuevo contrato', ['create'], ['class' => 'btn btn-block btn-success']) ?>
        </div>
    </div>



</div>
