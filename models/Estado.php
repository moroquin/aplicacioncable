<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado".
 *
 * @property string $nombre
 * @property string|null $descripcion
 * @property int|null $nivelautorizacion
 *
 * @property Servicioscontratados[] $servicioscontratados
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['nivelautorizacion'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['nombre'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'nivelautorizacion' => 'Nivelautorizacion',
        ];
    }

    /**
     * Gets query for [[Servicioscontratados]].
     *
     * @return \yii\db\ActiveQuery|ServicioscontratadosQuery
     */
    public function getServicioscontratados()
    {
        return $this->hasMany(Servicioscontratados::className(), ['nombreestado' => 'nombre']);
    }

    /**
     * {@inheritdoc}
     * @return EstadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstadoQuery(get_called_class());
    }
}
