<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado".
 *
 * @property int $idestado
 * @property string|null $nombre
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
            [['nombre'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idestado' => 'Idestado',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Servicioscontratados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicioscontratados()
    {
        return $this->hasMany(Servicioscontratados::className(), ['idestado' => 'idestado']);
    }
}
