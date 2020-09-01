<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%puesto}}".
 *
 * @property int $idpuestos
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property int|null $nivel
 *
 * @property Empleado[] $empleados
 */
class Puesto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%puesto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['nivel'], 'integer'],
            [['nombre'], 'string', 'max' => 75],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpuestos' => Yii::t('app', 'Idpuestos'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'nivel' => Yii::t('app', 'Nivel'),
        ];
    }

    /**
     * Gets query for [[Empleados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['puestos_idpuestos' => 'idpuestos']);
    }
}
