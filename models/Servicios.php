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
            [['tarifa'], 'number'],
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 100],
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
            'tarifa' => 'Tarifa',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[Servicioscontratados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicioscontratados()
    {
        return $this->hasOne(Servicioscontratados::className(), ['idservicio' => 'idservicio']);
    }

    /**
     * Gets query for [[Idclientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdclientes()
    {
        return $this->hasMany(Clientes::className(), ['idcliente' => 'idcliente'])->viaTable('servicioscontratados', ['idservicio' => 'idservicio']);
    }
}
