<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicioscontratados".
 *
 * @property int|null $mesesnopagados
 * @property float|null $subtotal
 * @property int $idcliente
 * @property int $idservicio
 * @property string $contratonumero
 * @property float|null $cobropactado
 * @property int|null $duracioncontrato
 * @property string|null $fechainicio
 * @property int $idservicioscontratados
 * @property string|null $nombrezona
 * @property string $nombreestado
 * @property string $detmesesporpagar
 * @property int|null $trabajopendiente
 * @property string|null $fechareconexion
 * @property string|null $fechasuspension
 * @property string|null $descripcionreconexion
 * @property string|null $descripcionsuspension
 * @property float|null $cobroreconexion
 *
 * @property Cobros[] $cobros
 * @property Clientes $idcliente0
 * @property Estado $nombreestado0
 * @property Servicios $idservicio0
 * @property Trabajospendientes[] $trabajospendientes
 */
class Servicioscontratados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servicioscontratados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mesesnopagados', 'idcliente', 'idservicio', 'duracioncontrato'], 'integer'],
            [['subtotal', 'cobropactado','cobroreconexion'], 'number'],
            [['idcliente', 'idservicio', 'contratonumero', 'nombreestado'], 'required'],
            [['fechainicio','fechasuspension', 'fechareconexion'], 'safe'],
            [['nombrezona','contratonumero', 'nombreestado'], 'string', 'max' => 45],
            [['descripcionsuspension','descripcionreconexion'], 'string', 'max' => 255],
            [['detmesesporpagar'], 'string', 'max' => 500],
            //[['nombrezona'], 'string', 'max' => 45],
            //[['idcliente'], 'unique'],
            //[['idservicio'], 'unique'],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['nombreestado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['nombreestado' => 'nombre']],
            [['idservicio'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::className(), 'targetAttribute' => ['idservicio' => 'idservicio']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [


            'primernombre' => 'Nombres',
            'segundonombre' => ' ',

            'primerapelldio' => 'Apellidos',
            'segundoapellido' => ' ',


            'mesesnopagados' => 'Meses por pagar(Pagos adelantados signo - )',
            'subtotal' => 'Sub total',
            'idcliente' => 'Idcliente',
            'idservicio' => 'Idservicio',
            'contratonumero' => 'Número contrato',
            'cobropactado' => 'Cobro pactado',
            'duracioncontrato' => 'Duracion de contrato',
            'fechainicio' => 'Fecha inicio',
            'idservicioscontratados' => 'Idservicioscontratados',
            'nombrezona' => 'Zona agrupación',
            'nombreestado' => 'Estado',
            'detmesesporpagar' => 'Meses por pagar',

            'fechareconexion'=> 'Fecha re conexión',
            'fechasuspension' =>'Fecha de suspensión',
            'descripcionsuspension' => 'Descripción suspensión',
            'descripcionreconexion'=>'Descripción re conexión',

            'cobroreconexion'=> 'Cobro de Reconexión'
            
        ];
    }

    /**
     * Gets query for [[Cobros]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCobros()
    {
        return $this->hasMany(Cobros::className(), ['idservicioscontratados' => 'idservicioscontratados']);
    }

    public function getCliente(){
        return Clientes::findOne(['idcliente'=> $this->idcliente]);
        //return $this->hasOne(Clientes::className(),['idcliente'=>$this->idcliente])->getZona();
    }

    /**
     * Gets query for [[Clientes]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasOne(Clientes::className(), ['idcliente' => 'idcliente']);
    }

    

    public static function getIdserviciocliente(){
        $result = Servicioscontratados::find()
                ->where(['nombreestado'=>'Activo'])
                ->orWhere(['nombreestado'=>'Moroso'])
                ->orWhere(['nombreestado'=>'Suspendido'])
                ->all();

        $serviciosgeneral = Servicios::listadoServicioscompleto();


        $servicios = [];

        foreach ($result as $record){
                $cliente = $record->getCliente();
                $servicios[$record->idservicioscontratados] = $cliente->getNombres() . '. ' . $serviciosgeneral[$record->idservicio];
            }
        
        return $servicios;
    }


    

    public static function getIdservicioclientecompleto(){
        $result = Servicioscontratados::find()
                ->where(['nombreestado'=>['Activo', 'Moroso', 'Suspendido']])
                ->all();

        $serviciosgeneral = Servicios::listadoServicioscompleto();


        $servicios = [];

        foreach ($result as $record){
                $cliente = $record->getCliente();
                $servicios[$record->idservicioscontratados] = [
                    'nombre'=>$cliente->getNombres() . '. ' . $serviciosgeneral[$record->idservicio],
                    'mesesporpagar'=>$record->mesesnopagados,
                    'cobropactado'=>$record->cobropactado,
                ];
            }
        
        return $servicios;
    }


    public static function getIdserviciozona(){
        $result = Servicioscontratados::find()
                ->where(['nombreestado'=>'Activo'])
                ->orWhere(['nombreestado'=>'Moroso'])
                ->all();

        


        $serviciosz = [];

        foreach ($result as $record){
                
                $serviciosz[$record->idservicioscontratados] = $record->zona;
            }
        
        return $serviciosz;
    }


    /**
     * Gets query for [[Idcliente0]].
     *
     * @return \yii\db\ActiveQuery|ClientesQuery
     */
    public function getIdcliente0()
    {
        return $this->hasOne(Clientes::className(), ['idcliente' => 'idcliente']);
    }

    /**
     * Gets query for [[Nombreestado0]].
     *
     * @return \yii\db\ActiveQuery|EstadoQuery
     */
    public function getNombreestado0()
    {
        return $this->hasOne(Estado::className(), ['nombre' => 'nombreestado']);
    }

    /**
     * Gets query for [[Idservicio0]].
     *
     * @return \yii\db\ActiveQuery|ServiciosQuery
     */
    public function getIdservicio0()
    {
        return $this->hasOne(Servicios::className(), ['idservicio' => 'idservicio']);
    }

    /**
     * hace los cambios cuando se crea el cliente
     */
    public function guardar($model)
    {
        $this->idcliente = $model->getIdcliente();
        $this->nombrezona = $model->getZona();
        
        return $this->save();  
    }




    public function beforeSave($insert) {
        if (isset($this->nombreestado))
            if (($this->nombreestado=='Finalizado')|| ($this->nombreestado=='Suspendido'))
                return parent::beforeSave($insert);

        if ($this->mesesnopagados<=1)
            $this->nombreestado = 'Activo';
        else 
            $this->nombreestado = 'Moroso';
    
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     * @return ServicioscontratadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServicioscontratadosQuery(get_called_class());
    }

    public function getZona(){
        return Clientes::findOne(['idcliente'=> $this->idcliente])->getZona();
        //return $this->hasOne(Clientes::className(),['idcliente'=>$this->idcliente])->getZona();
    }

    public function setMesnopagado(){
        $this->mesesnopagados++;
    }

    public function getMesnopagado(){
        return $this->mesesnopagados;
    }

    public function getCobropactado(){
        return $this->cobropactado;
    }

    public function getDeuda(){
        return $this->cobropactado * $this->mesesnopagados;
    }

    public function getId(){
        return $this->idservicioscontratados;
    }

    public function setMesesporpagardet($meses){
        $this->detmesesporpagar = $meses;

    }

    
}
