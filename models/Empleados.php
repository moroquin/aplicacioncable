<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%empleados}}".
 *
 * @property int $idempleado
 * @property string|null $nombre
 * @property string|null $apellido
 * @property string|null $telefono
 * @property string|null $direccion
 * @property int $puestos_idpuestos
 *
 * @property Cobro[] $cobros
 * @property Puesto $puestosIdpuestos
 * @property User[] $users
 */
class Empleados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%empleados}}';
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
            [['puestos_idpuestos'], 'exist', 'skipOnError' => true, 'targetClass' => Puesto::className(), 'targetAttribute' => ['puestos_idpuestos' => 'idpuestos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idempleado' => Yii::t('app', 'Idempleado'),
            'nombre' => Yii::t('app', 'Nombres'),
            'apellido' => Yii::t('app', 'Apellidos'),
            'telefono' => Yii::t('app', 'Numero de Telefono'),
            'direccion' => Yii::t('app', 'Direccion'),
            'puestos_idpuestos' => Yii::t('app', 'Puesto'),
        ];
    }

    /**
     * Gets query for [[Cobros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCobros()
    {
        return $this->hasMany(Cobro::className(), ['idempleado' => 'idempleado']);
    }

    /**
     * Gets query for [[PuestosIdpuestos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPuestosIdpuestos()
    {
        return $this->hasOne(Puesto::className(), ['idpuestos' => 'puestos_idpuestos']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['empleados_idempleado' => 'idempleado']);
    }
}
