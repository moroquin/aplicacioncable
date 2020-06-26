<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

$this->title = $model->primernombre . ' ' . $model->segundonombre . ' ' . $model->primerapelldio . ' ' . $model->segundoapellido;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clientes-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idcliente',
            'correlativo',
          //  'primernombre',
          //  'segundonombre',
          //  'primerapelldio',
          //  'segundoapellido',
            'direccion:ntext',
            'dpi',
            'referencias:ntext',
            'telefono1',
            'telefono2',
            'nit',
            'nombrezona',
            'mail',
        ],
    ]) ?>


    <p>
        <div class="col-xs-12">
            <?= Html::a('Actualizar ', ['update', 'id' => $model->idcliente], ['class' => 'btn btn-block btn-primary']) ?>
        </div>
        <!--    < ? = Html::a('Delete', ['delete', 'id' => $model->idcliente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ? >  -->
    </p>

</div>