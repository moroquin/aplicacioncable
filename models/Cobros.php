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
 * @property float|null $totalcobrado
 * @property int $idservicioscontratados
 * @property string|null $tipo
 * @property string|null $factura
 * @property string|null $contrasenya
 * @property string|null $zona
 * @property string|null $anyomes
 * @property string|null $mesesporcobrardet
 * @property int|null $mesespagados
 * @property float|null $totalporcobrar
 * @property int|null $mesesporcobrar
 * @property int|null $lote_idlote
 *
 * @property Empleados $idempleado0
 * @property Lote $loteIdlote
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
            [['tipo', 'factura', 'contrasenya', 'zona', 'mesesporcobrardet'], 'string', 'max' => 45],
            [['anyomes'], 'string', 'max' => 7],
            [['idempleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleados::className(), 'targetAttribute' => ['idempleado' => 'idempleado']],
            [['lote_idlote'], 'exist', 'skipOnError' => true, 'targetClass' => Lote::className(), 'targetAttribute' => ['lote_idlote' => 'idlote']],
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
            'totalporcobrar' => 'Monto por cobrar',
            'totalcobrado' => 'Cobro',
            
            'idservicioscontratados' => 'Idservicioscontratados',
            'tipo' => 'Tipo',
            'factura' => 'Factura',
            'contrasenya' => 'Contraseñaa',
            'zona' => 'Zona',
            'anyomes' => 'Año - Mes',
            'mesespagados'=>'Meses pagados',
            'mesesporcobrar'=>'Meses por pagar',
            'mesesporcobrardet' => 'Meses por pagar'
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
     * Gets query for [[LoteIdlote]].
     *
     * @return \yii\db\ActiveQuery|LoteQuery
     */
    public function getLoteIdlote()
    {
        return $this->hasOne(Lote::className(), ['idlote' => 'lote_idlote']);
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

    public static function getCobros($zona, $anyomes){

        $result = Cobros::find()
                ->where(['anyomes'=>$anyomes, 'zona'=>$zona])
                ->all();
              
        return $result;


    }

    public function guardar(){
        $result1 = Cobros::findOne($this->idcobro);
        $result1->mesespagados = $this->mesespagados;
        $result1->totalcobrado = $this->totalcobrado;
        $result1->save();

        $result = Servicioscontratados::findOne($this->idservicioscontratados);
        $result->mesesnopagados = $result->mesesnopagados - $this->mesespagados;
        $result->save();
        $this->save();
    }
}
