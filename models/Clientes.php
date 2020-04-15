<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $idcliente
 * @property string|null $correlativo
 * @property string|null $primernombre
 * @property string|null $segundonombre
 * @property string|null $primerapelldio
 * @property string|null $segundoapellido
 * @property string|null $direccion
 * @property string|null $dpi
 * @property string|null $referencias
 * @property string|null $telefono1
 * @property string|null $telefono2
 * @property string|null $nit
 * @property string $nombrezona
 *
 * @property Zona $nombrezona0
 * @property Servicioscontratados $servicioscontratados
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['direccion', 'referencias'], 'string'],
            [['nombrezona'], 'required'],
            [['correlativo'], 'string', 'max' => 5],
            [['primernombre', 'segundonombre', 'primerapelldio', 'segundoapellido'], 'string', 'max' => 75],
            [['dpi'], 'string', 'max' => 15],
            [['telefono1', 'telefono2'], 'string', 'max' => 40],
            [['nit', 'nombrezona'], 'string', 'max' => 45],
            [['nombrezona'], 'exist', 'skipOnError' => true, 'targetClass' => Zona::className(), 'targetAttribute' => ['nombrezona' => 'nombrezona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcliente' => 'Idcliente',
            'correlativo' => 'Correlativo',
            'primernombre' => 'Primernombre',
            'segundonombre' => 'Segundonombre',
            'primerapelldio' => 'Primerapelldio',
            'segundoapellido' => 'Segundoapellido',
            'direccion' => 'Direccion',
            'dpi' => 'Dpi',
            'referencias' => 'Referencias',
            'telefono1' => 'Telefono1',
            'telefono2' => 'Telefono2',
            'nit' => 'Nit',
            'nombrezona' => 'Nombrezona',
        ];
    }

    /**
     * Gets query for [[Nombrezona0]].
     *
     * @return \yii\db\ActiveQuery|ZonaQuery
     */
    public function getNombrezona0()
    {
        return $this->hasOne(Zona::className(), ['nombrezona' => 'nombrezona']);
    }

    /**
     * Gets query for [[Servicioscontratados]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getServicioscontratados()
    {
        return $this->hasOne(Servicioscontratados::className(), ['idcliente' => 'idcliente']);
    }

    /**
     * {@inheritdoc}
     * @return ClientesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientesQuery(get_called_class());
    }
}
