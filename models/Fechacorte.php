<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fechacorte".
 *
 * @property int $idfechacorte
 * @property string|null $fechacorte
 *
 * @property Servicioscontratados[] $servicioscontratados
 */
class Fechacorte extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fechacorte';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fechacorte'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfechacorte' => 'Idfechacorte',
            'fechacorte' => 'Fechacorte',
        ];
    }

    /**
     * Gets query for [[Servicioscontratados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicioscontratados()
    {
        return $this->hasMany(Servicioscontratados::className(), ['idfechacorte' => 'idfechacorte']);
    }
}
