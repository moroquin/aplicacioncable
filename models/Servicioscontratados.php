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
 * @property string $nombreestado
 * @property int $idservicioscontratados
 * @property string|null $corte
 *
 * @property Cobros[] $cobros
 * @property Clientes $idcliente0
 * @property Estado $nombreestado0
 * @property Servicios $idservicio0
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
            [['subtotal', 'cobropactado'], 'number'],
            [['idcliente', 'idservicio', 'contratonumero', 'nombreestado'], 'required'],
            [['fechainicio'], 'safe'],
            [['contratonumero'], 'string', 'max' => 45],
            [['nombreestado'], 'string', 'max' => 60],
            [['corte'], 'string', 'max' => 4],
            [['idcliente'], 'unique'],
            [['idservicio'], 'unique'],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['nombreestado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['nombreestado' => 'nombreestado']],
            [['idservicio'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::className(), 'targetAttribute' => ['idservicio' => 'idservicio']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mesesnopagados' => 'Mesesnopagados',
            'subtotal' => 'Subtotal',
            'idcliente' => 'Idcliente',
            'idservicio' => 'Idservicio',
            'contratonumero' => 'Contratonumero',
            'cobropactado' => 'Cobropactado',
            'duracioncontrato' => 'Duracioncontrato',
            'fechainicio' => 'Fechainicio',
            'nombreestado' => 'Nombreestado',
            'idservicioscontratados' => 'Idservicioscontratados',
            'corte' => 'Corte',
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
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getNombreestado0()
    {
        return $this->hasOne(Estado::className(), ['nombreestado' => 'nombreestado']);
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
     * {@inheritdoc}
     * @return ServicioscontratadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServicioscontratadosQuery(get_called_class());
    }
}
