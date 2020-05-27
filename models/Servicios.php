<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicios".
 *
 * @property int $idservicio
 * @property string|null $nombre
 * @property float|null $tarifa
 * @property string|null $descripcion
 * @property string|null $tiposervicio
 * @property int|null $disponible
 *
 * @property Servicioscontratados $servicioscontratados
 */
class Servicios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servicios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarifa'], 'number'],
            [['descripcion'], 'string'],
            [['disponible'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['tiposervicio'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idservicio' => 'Idservicio',
            'nombre' => 'Nombre',
            'tarifa' => 'Tarifa',
            'descripcion' => 'Descripcion',
            'tiposervicio' => 'Tiposervicio',
            'disponible' => 'Disponible',
        ];
    }

    /**
     * Gets query for [[Servicioscontratados]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getServicioscontratados()
    {
        return $this->hasOne(Servicioscontratados::className(), ['idservicio' => 'idservicio']);
    }

    /**
     * {@inheritdoc}
     * @return ServiciosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServiciosQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     * @return servicios Array de salida de servicios prestados
     */
    public function listadoServicios($activo){
        $result = Servicios::find()->all();

        $servicios = [];

        foreach ($result as $record)
            if ($activo == $record->disponible)
                $servicios[$record->idservicio] = $record->nombre . ". Q. " . $record->tarifa;
        
        return $servicios;
    }

    public function listadoServicioscompleto(){
        $result = Servicios::find()->all();

        $servicios = [];

        foreach ($result as $record)
                $servicios[$record->idservicio] = $record->nombre . ". Q. " . $record->tarifa;
        
        return $servicios;
    }

    /**
     * {@inheritdoc}
     * @return costos Array de salida de servicios prestados
     */
    public function listadoTarifas($activo){
        $result = Servicios::find()->all();

        $costos = [];

        foreach ($result as $record)
            if ($activo == $record->disponible)
                $costos[$record->idservicio] = $record->tarifa;
        
        return $costos;

    }

    public static function getTarifa($id){
        
        return Servicios::findOne($id)->tarifa;
    }

}
