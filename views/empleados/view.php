<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleados */

$this->title = 'Informacion de Empleado';

\yii\web\YiiAsset::register($this);
?>
<div class="empleados-view">
    <div class="page-header">
        <h1>Informacion del Empleado</h1>
    
    </div>
    
    <p>
        <?= Html::a(Yii::t('app', 'Actualizar Informacion Personal del Empleado'), ['update', 'id' => $model->idempleado], ['class' => 'btn btn-primary btn-lg btn-block']) ?>
        
    </p>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h2 > Informacion del Empleado</h2>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                    'nombre',
                    'apellido',
                    'telefono',
                    'direccion',
                ],
            ]) ?>
        </div>
        <div class="panel-heading">
            <h2 > Informacion del Puesto</h2>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
            'model' => $model1,
            'attributes' => [
                    'nombre',
                    'descripcion',
                ],
            ]) ?>
        </div>
        <div class="panel-heading">
            <h2 > Informacion de la cuenta</h2>
        </div>
        <div class="panel-body">
            <?php
            if($model2 == null){
                echo '
                    <div class="alert alert-danger" role="alert">No se completo el proceso de registro, No se creo el usuario. 
                    Por favor, registre un usuario para el empleado.
                    </div>
                ';
                echo Html::a(Yii::t('app', 'Registrar Usuario'), ['/site/signup', 'id' => $model->idempleado, 'acceso' => $model1->nivel], ['class' => 'btn btn-danger btn-lg btn-block']);
            }else{
                echo DetailView::widget([
                    'model' => $model2,
                    'attributes' => [
                            'username',
                            'email',
                        ],
                    ]) ; 
            }?>
        </div>
        <div class="panel-footer">
            <?php echo Html::a(Yii::t('app', 'Regresar'), ['/empleados/index'], ['class' => 'btn btn-info btn-lg btn-block']);?>
        </div>
    </div>
    


    <div class="panel panel-danger">
        
        <?php
            if($model2 != null){

                if($model2->estado == 1){
                    echo '
                    <div class="panel-heading"> <h1>Zona de peligro<br><small>El siguiente boton permite cambiar la contraseña del usuario</small></h1></div><div class="panel-body">
                    ';
                    
                    echo Html::a(Yii::t('app', 'Actualizar password'), ['/site/actualizarcontra', 'id' => $model2->id], ['class' => 'btn btn-primary btn-lg btn-block']);
                    echo '
                        </div><div class="panel-heading"> <h1><small>El siguiente boton Inactiva el usuario en cuestion</small></h1></div><div class="panel-body">
                    ';
                    echo Html::a(Yii::t('app', 'Desactivar usuario'), ['/empleados/cambioestado', 'id' => $model2->id, 'estado' => 0], ['class' => 'btn btn-danger btn-lg btn-block',
                    'data' => [
                        'confirm' => Yii::t('app', 'Esta seguro que desea desactivar el usuario?'),
                    ],]);
                    echo '</div>';
                        
                }else{
                    echo '
                    <div class="panel-heading">  <h1>Zona de peligro<br><small>El usuario actualmente se encuentra inactivo</small></h1></div><div class="panel-body">
                    ';
                    echo Html::a(Yii::t('app', 'Activar usuario'), ['/empleados/cambioestado', 'id' => $model2->id, 'estado' => 1], ['class' => 'btn btn-danger btn-lg btn-block',
                    'data' => [
                        'confirm' => Yii::t('app', 'Esta seguro que desa activar el usuario?'),
                    ],]);
                    echo '</div>';
                }
            }
        ?>
    </div>
   
</div>
