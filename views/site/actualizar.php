<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleados */

$this->title = Yii::t('app', 'Actualizar password');
?>
<div class="empleados-update">


    <?= $this->render('actualizarform', [
        'model' => $model,
        'model2' => $model2,
    ]) ?>

</div>
