<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleados */

$this->title = 'Informacion de Empleado';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empleados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="empleados-view">
    <div class="page-header">
        <h1>Informacion del Empleado</h1>
    
    </div>
    
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idempleado], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idempleado], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="alert alert-info" role="alert">
       <h3> Informacion del Empleado</h3>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'apellido',
            'telefono',
            'direccion',
        ],
    ]) ?>
    <div class="alert alert-info" role="alert">
       <h3> Informacion del Puesto</h3>
    </div>
    <?= DetailView::widget([
        'model' => $model1,
        'attributes' => [
            'nombre',
            'descripcion',
        ],
    ]) ?>
</div>
