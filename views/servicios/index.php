<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Servicios Prestados: ' . (($searchModel->disponible == 1) ? ' ACTIVOS ' : ' DE BAJA ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicios-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //   'idservicio',
            'nombre',
            'tarifa',
            'descripcion:ntext',
            'tiposervicio',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actualizar',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'lead-update'),
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = 'update?id=' . $model->idservicio;
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>


    <div class="row">
        <div class="col-xs-4">
            <p>
                <?= Html::a('Crear Nuevo Servicio', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-xs-4">
            <p>

                <?= Html::a(Yii::t('app', (($searchModel->disponible) ? 'Mostrar servicios <strong>de baja</strong>.' : 'Mostrar servicios <strong>de alta</strong>.')), ['servicios/indexx', 'disponible' => $searchModel->disponible], ['class' => ($searchModel->disponible) ? 'btn btn-danger' : 'btn btn-warning']) ?>
            </p>
        </div>
    </div>




</div>