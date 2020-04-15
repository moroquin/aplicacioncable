<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zona".
 *
 * @property string $nombrezona
 *
 * @property Clientes[] $clientes
 */
class Zona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombrezona'], 'required'],
            [['nombrezona'], 'string', 'max' => 45],
            [['nombrezona'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nombrezona' => 'Nombrezona',
        ];
    }

    /**
     * Gets query for [[Clientes]].
     *
     * @return \yii\db\ActiveQuery|ClientesQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['nombrezona' => 'nombrezona']);
    }

    /**
     * {@inheritdoc}
     * @return ZonaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ZonaQuery(get_called_class());
    }
}
