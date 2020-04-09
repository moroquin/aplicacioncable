<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trabajospendientes".
 *
 * @property int $idtrabajospendientes
 * @property int $idtrabajos
 * @property int $idservicioscontratados
 * @property string|null $fechaorden
 * @property string|null $fecharealizar
 * @property int $servicioscontratados_idcliente
 * @property int $servicioscontratados_idservicio
 *
 * @property Servicioscontratados $servicioscontratadosIdcliente
 * @property Trabajos $idtrabajos0
 */
class Trabajospendientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trabajospendientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtrabajos', 'idservicioscontratados', 'servicioscontratados_idcliente', 'servicioscontratados_idservicio'], 'required'],
            [['idtrabajos', 'idservicioscontratados', 'servicioscontratados_idcliente', 'servicioscontratados_idservicio'], 'integer'],
            [['fechaorden'], 'safe'],
            [['fecharealizar'], 'string', 'max' => 45],
            [['servicioscontratados_idcliente', 'servicioscontratados_idservicio'], 'exist', 'skipOnError' => true, 'targetClass' => Servicioscontratados::className(), 'targetAttribute' => ['servicioscontratados_idcliente' => 'idcliente', 'servicioscontratados_idservicio' => 'idservicio']],
            [['idtrabajos'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajos::className(), 'targetAttribute' => ['idtrabajos' => 'idtrabajos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtrabajospendientes' => 'Idtrabajospendientes',
            'idtrabajos' => 'Idtrabajos',
            'idservicioscontratados' => 'Idservicioscontratados',
            'fechaorden' => 'Fechaorden',
            'fecharealizar' => 'Fecharealizar',
            'servicioscontratados_idcliente' => 'Servicioscontratados Idcliente',
            'servicioscontratados_idservicio' => 'Servicioscontratados Idservicio',
        ];
    }

    /**
     * Gets query for [[ServicioscontratadosIdcliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicioscontratadosIdcliente()
    {
        return $this->hasOne(Servicioscontratados::className(), ['idcliente' => 'servicioscontratados_idcliente', 'idservicio' => 'servicioscontratados_idservicio']);
    }

    /**
     * Gets query for [[Idtrabajos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdtrabajos0()
    {
        return $this->hasOne(Trabajos::className(), ['idtrabajos' => 'idtrabajos']);
    }
}
