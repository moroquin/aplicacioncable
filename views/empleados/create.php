<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleados */

$this->title = Yii::t('app', 'Registrar Empleado');
?>
<div class="empleados-create">


    <?= $this->render('_form', [
        'model' => $model,
        'puestos' => $puestos,
    ]) ?>

</div>
