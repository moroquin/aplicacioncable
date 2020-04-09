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
 * @property int $idcliente
 * @property int $idservicio
 *
 * @property Empleados $idempleado0
 * @property Servicioscontratados $idcliente0
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
            [['idempleado', 'idcliente', 'idservicio'], 'required'],
            [['idempleado', 'idcliente', 'idservicio'], 'integer'],
            [['fecha'], 'safe'],
            [['total'], 'number'],
            [['numerofactura'], 'string', 'max' => 100],
            [['idempleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleados::className(), 'targetAttribute' => ['idempleado' => 'idempleado']],
            [['idcliente', 'idservicio'], 'exist', 'skipOnError' => true, 'targetClass' => Servicioscontratados::className(), 'targetAttribute' => ['idcliente' => 'idcliente', 'idservicio' => 'idservicio']],
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
            'total' => 'Total',
            'idcliente' => 'Idcliente',
            'idservicio' => 'Idservicio',
        ];
    }

    /**
     * Gets query for [[Idempleado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdempleado0()
    {
        return $this->hasOne(Empleados::className(), ['idempleado' => 'idempleado']);
    }

    /**
     * Gets query for [[Idcliente0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcliente0()
    {
        return $this->hasOne(Servicioscontratados::className(), ['idcliente' => 'idcliente', 'idservicio' => 'idservicio']);
    }
}
