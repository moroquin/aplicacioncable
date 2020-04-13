<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicios".
 *
 * @property int $idservicio
 * @property string|null $nombre
 * @property float|null $tarifa
 * @property string|null $descripcion
 * @property string|null $tiposervicio
 * @property int|null $disponible
 *
 * @property Servicioscontratados $servicioscontratados
 * @property Clientes[] $idclientes
 */
class Servicios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servicios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarifa'], 'double'],
            [['descripcion'], 'string'],
            [['disponible'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['tiposervicio'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idservicio' => 'Idservicio',
            'nombre' => 'Nombre',
            'tarifa' => 'Tarifa Q.',
            'descripcion' => 'Descripcion',
            'tiposervicio' => 'Tipo de Servicio',
            'disponible' => 'Estado del Servicio',
        ];
    }

    /**
     * Gets query for [[Servicioscontratados]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getServicioscontratados()
    {
        return $this->hasOne(Servicioscontratados::className(), ['idservicio' => 'idservicio']);
    }

    /**
     * Gets query for [[Idclientes]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getIdclientes()
    {
        return $this->hasMany(Clientes::className(), ['idcliente' => 'idcliente'])->viaTable('servicioscontratados', ['idservicio' => 'idservicio']);
    }

    /**
     * {@inheritdoc}
     * @return ServiciosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServiciosQuery(get_called_class());
    }
}
