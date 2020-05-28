<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idcliente',
            'correlativo',
            'primernombre',
            'segundonombre',
            'primerapelldio',
            'segundoapellido',
            //'direccion:ntext',
            'dpi',
            //'referencias:ntext',
            //'telefono1',
            //'telefono2',
            'nit',
            'nombrezona',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'Actualizar cliente'),
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = 'update?id=' . $model->idcliente;
                        return $url;
                    }
                }
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'Ver detalle del cliente'),
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url = 'view?id=' . $model->idcliente;
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>


    <div class="panel panel-primary">
        <div class="col-xs-12"><?= Html::a('Agregar un nuevo cliente', ['create'], ['class' => 'btn btn-block btn-success']) ?></div>
    </div>

</div>
