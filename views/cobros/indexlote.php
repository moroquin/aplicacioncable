<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CobrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listado de cobros por zona';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cobros-index">




    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(); ?>




    <div class="panel panel-primary">
        <div class="panel-heading">Seleccione la zona para agregar un conjunto de cobros. </div>
        <div class="panel-body">

            <div class="col-xs-6">
                <?= $form->field($zona, 'nombrezona')
                    ->widget(Select2::classname(), [
                        'data' =>  $listadozonas,
                        'options' => ['tag' => true, 'placeholder' => 'Seleccione la zona para ingresar los pagos'],
                        'pluginOptions' => ['allowClear' => true,],

                    ])->label(false) ?>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <?= Html::submitButton('Agregar cobros por zona', ['class' => 'btn btn-block btn-success']) ?>
                </div>
            </div>


        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>


    <div class="panel panel-primary">
        <div class="panel-heading">Listado de cobros agrupados por zona </div>
        <div class="panel-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [

                    'fecha',

                    'anyomes',
                    'zona',

                    'totalcobrado',


                    //adios

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Ver',
                        'headerOptions' => ['style' => 'color:#337ab7'],
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-update'),
                                    'data-pjax' => 0, 'target' => "_blank"
                                ]);
                            },
                       
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'update') {
                                $url = 'verlote?id=' . $model->idlote;
                                return $url;
                            }

                    
                        }
                    ],


                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Imprimir',
                        'headerOptions' => ['style' => 'color:#337ab7'],
                        'template' => '{view}',
                        'buttons' => [
                            
                            'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-view'),
                                    'data-pjax' => 0, 'target' => "_blank"
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            
                            if ($action === 'view') {
                                $url = 'reporte?zona='.$model->zona.'&anyomes='.$model->anyomes;
                                return $url;
                            }
                        }
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>







</div>