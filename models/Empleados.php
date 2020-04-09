<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleados".
 *
 * @property int $idempleado
 * @property string|null $nombre
 * @property string|null $apellido
 * @property string|null $telefono
 * @property string|null $direccion
 * @property int $puestos_idpuestos
 *
 * @property Cobros[] $cobros
 * @property Puestos $puestosIdpuestos
 */
class Empleados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['puestos_idpuestos'], 'required'],
            [['puestos_idpuestos'], 'integer'],
            [['nombre', 'apellido'], 'string', 'max' => 50],
            [['telefono'], 'string', 'max' => 40],
            [['direccion'], 'string', 'max' => 45],
            [['puestos_idpuestos'], 'exist', 'skipOnError' => true, 'targetClass' => Puestos::className(), 'targetAttribute' => ['puestos_idpuestos' => 'idpuestos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idempleado' => 'Idempleado',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'puestos_idpuestos' => 'Puestos Idpuestos',
        ];
    }

    /**
     * Gets query for [[Cobros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCobros()
    {
        return $this->hasMany(Cobros::className(), ['idempleado' => 'idempleado']);
    }

    /**
     * Gets query for [[PuestosIdpuestos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPuestosIdpuestos()
    {
        return $this->hasOne(Puestos::className(), ['idpuestos' => 'puestos_idpuestos']);
    }
}
