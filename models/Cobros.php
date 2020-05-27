<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cobros".
 *
 * @property int $idcobro
 * @property string|null $numerofactura
 * @property int $idempleado
 * @property string|null $fecha
 * @property float|null $total
 * @property int $idservicioscontratados
 * @property string|null $tipo
 * @property string|null $factura
 * @property string|null $contrasenya
 * @property string|null $zona
 * @property string|null $anyomes
 * @property int $mesesporcobrar
 * @property int $mesespagados
 *
 * @property Empleados $idempleado0
 * @property Servicioscontratados $idservicioscontratados0
 */
class Cobros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cobros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idempleado', 'idservicioscontratados'], 'required'],
            [['idempleado', 'idservicioscontratados', 'mesesporcobrar','mesespagados'], 'integer'],
            [['fecha'], 'safe'],
            [['totalporcobrar', 'totalcobrado'], 'number'],
            [['numerofactura'], 'string', 'max' => 100],
            [['tipo', 'factura', 'contrasenya', 'zona'], 'string', 'max' => 45],
            [['anyomes'], 'string', 'max' => 7],
            [['idempleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleados::className(), 'targetAttribute' => ['idempleado' => 'idempleado']],
            [['idservicioscontratados'], 'exist', 'skipOnError' => true, 'targetClass' => Servicioscontratados::className(), 'targetAttribute' => ['idservicioscontratados' => 'idservicioscontratados']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcobro' => 'Idcobro',
            'numerofactura' => 'Numerofactura',
            'idempleado' => 'Idempleado',
            'fecha' => 'Fecha',
            'totalporcobrar' => 'Debe cobrar',
            'totalcobrado' => 'Cobro',
            
            'idservicioscontratados' => 'Idservicioscontratados',
            'tipo' => 'Tipo',
            'factura' => 'Factura',
            'contrasenya' => 'Contrasenya',
            'zona' => 'Zona',
            'anyomes' => 'Anyomes',
            'mesespagados'=>'mesespagados',
            'mesesporcobrar'=>'mesesporcobrar',
        ];
    }

    /**
     * Gets query for [[Idempleado0]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getIdempleado0()
    {
        return $this->hasOne(Empleados::className(), ['idempleado' => 'idempleado']);
    }

    /**
     * Gets query for [[Idservicioscontratados0]].
     *
     * @return \yii\db\ActiveQuery|ServicioscontratadosQuery
     */
    public function getIdservicioscontratados0()
    {
        return $this->hasOne(Servicioscontratados::className(), ['idservicioscontratados' => 'idservicioscontratados']);
    }

    /**
     * {@inheritdoc}
     * @return CobrosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CobrosQuery(get_called_class());
    }
}
