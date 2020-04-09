<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trabajos".
 *
 * @property int $idtrabajos
 * @property string|null $nombre
 * @property string|null $monto
 *
 * @property Trabajospendientes[] $trabajospendientes
 */
class Trabajos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trabajos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 75],
            [['monto'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtrabajos' => 'Idtrabajos',
            'nombre' => 'Nombre',
            'monto' => 'Monto',
        ];
    }

    /**
     * Gets query for [[Trabajospendientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajospendientes()
    {
        return $this->hasMany(Trabajospendientes::className(), ['idtrabajos' => 'idtrabajos']);
    }
}
