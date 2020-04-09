<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "puestos".
 *
 * @property int $idpuestos
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property int|null $nivel
 *
 * @property Empleados[] $empleados
 */
class Puestos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'puestos';
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
            'idpuestos' => 'Idpuestos',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'nivel' => 'Nivel',
        ];
    }

    /**
     * Gets query for [[Empleados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleados::className(), ['puestos_idpuestos' => 'idpuestos']);
    }
}
