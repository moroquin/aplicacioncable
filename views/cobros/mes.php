<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CobrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mes de cobro actual: ' . $anyomesant ;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cobros-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <p>Este botón sirve exclusivamente para crear los espacios para los cobros del siguiente mes.</p>
    <p>Para imprimir los recordatorios y actualizar los contratos y pagos a un nuevo mes es necesario crearlo. </p>

    <div class="row"><?=  Html::a('Generar cobros del mes: ' . $anyomes, ['cobrosmes'], ['class' => 'btn  btn-block btn-success'])  ?></div>

    



</div>