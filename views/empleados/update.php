<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleados */

$this->title = Yii::t('app', 'Actualizar Informacion');

?>
<div class="empleados-update">


    <?= $this->render('formupdate', [
        'model' => $model,
        'puestos' => $puestos,
    ]) ?>

</div>
