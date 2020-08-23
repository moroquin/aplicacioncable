<?php

namespace app\models;

use Yii;
use app\controllers\CobrosController;

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
 * @property string|null $mesespagadosdet
 * @property int|null $mesespagados
 * @property float|null $totalporcobrar
 * @property int|null $mesesporcobrar
 * @property int|null $lote_idlote
 * @property string|null $mesesporcobrardet
 * @property int $idcliente
 *
 * @property Clientes $idcliente0
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
            [['idempleado', 'idservicioscontratados', 'mesespagados', 'mesesporcobrar', 'lote_idlote', 'idcliente'], 'integer'],
            [['fecha'], 'safe'],
            [['totalcobrado', 'totalporcobrar'], 'number'],
            [['numerofactura'], 'string', 'max' => 100],
            [['tipo', 'factura', 'contrasenya', 'zona'], 'string', 'max' => 45],
            [['mesesporcobrardet', 'mesespagadosdet'], 'string', 'max' => 500],
            [['anyomes'], 'string', 'max' => 7],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
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

            'mesespagadosdet' => 'meses pagados',
            
            'idservicioscontratados' => 'Idservicioscontratados',
            'tipo' => 'Tipo',
            'factura' => 'Factura',
            'contrasenya' => 'Contraseñaa',
            'zona' => 'Zona',
            'anyomes' => 'Año - Mes',
            'mesespagados'=>'Meses pagados',
            'mesesporcobrar'=>'Meses por pagar',
            'mesesporcobrardet' => 'Meses por pagar',
            'idcliente' => 'Idcliente',
        ];
    }

    /**
     * Gets query for [[Idcliente0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcliente0()
    {
        return $this->hasOne(Clientes::className(), ['idcliente' => 'idcliente']);
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
     * Gets query for [[LoteIdlote]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoteIdlote()
    {
        return $this->hasOne(Lote::className(), ['idlote' => 'lote_idlote']);
    }

    /**
     * Gets query for [[Idservicioscontratados0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdservicioscontratados0()
    {
        return $this->hasOne(Servicioscontratados::className(), ['idservicioscontratados' => 'idservicioscontratados']);
    }

    public function getServicioscontratados()
    {
        return $this->hasOne(Servicioscontratados::className(), ['idservicioscontratados' => 'idservicioscontratados']);
    }

    public function getClientes()
    {
        return $this->hasOne(Clientes::className(), ['idcliente' => 'idcliente']);
    }

    public static function getCobros($zona, $anyomes){

        $result = Cobros::find()
                ->where(['anyomes'=>$anyomes, 'zona'=>$zona])
                ->all();
              
        return $result;


    }

    public function guardar(){
        
        $result1 = Cobros::findOne($this->idcobro);
        $result = Servicioscontratados::findOne($this->idservicioscontratados);

        
        $result1->mesespagados = $this->mesespagados;
        $result1->totalcobrado = $this->totalcobrado;
        $result1->idcliente = $result->idcliente;
        $result1->save();

        
        $result->mesesnopagados = $result->mesesnopagados - $this->mesespagados;
        $result->save();
        return true;
    }


    public function guardarnuevo(){
                
        $result = Servicioscontratados::findOne($this->idservicioscontratados);

        $anyomes = CobrosController::getAnyomes();

        $this->mesesporcobrardet = $result->detmesesporpagar;

        if ($this->mesespagados == $result->mesesnopagados)
            $this->mesespagadosdet = $this->mesesporcobrardet;
        else
            $this->mesespagadosdet = CobrosController::getMesesPagados($anyomes,$result->mesesnopagados,$this->mesespagados);
        



         /*if ($result->mesesnopagados = 0 )
            $this->mesesporcobrardet = "Al día";
        else if ($this->mesesporcobrardet > 0)
        $this->mesesporcobrardet = CobrosController::getMesesAtrazados($anyomes,$this->mesesporcobrar);
        else {
            
            $this->mesesporcobrardet ="Adelantado:". CobrosController::getMesesAtrazados($anyomes,-$this->mesesporcobrar);
        }*/

        //actualizando meses restantes de pago 
        $this->mesesporcobrar = $result->mesesnopagados;
        $result->mesesnopagados = $result->mesesnopagados - $this->mesespagados;

        if ($result->mesesnopagados == 0)
            $result->detmesesporpagar= "Al día";
        else if ($result->mesesnopagados > 0)
            $result->detmesesporpagar= CobrosController::getMesesAtrazados($anyomes,$result->mesesnopagados);
        else
            $result->detmesesporpagar= "Pagos adelantados ". (-$result->mesesnopagados);
            
        if ($result->mesesnopagados < 2)
            $result->nombreestado = 'Activo';

        $this->idcliente = $result->idcliente;

        $salida = '';
        if (!$this->save())
            $salida = $salida . ' ' . print_r($this->getErrors());
 
      
        if (!$result->save())
            $salida = $salida . ' ' . print_r($result->getErrors());
            
        

        return true;
        
    }



}
