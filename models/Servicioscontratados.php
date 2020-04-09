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
 * @property int $idfechacorte
 * @property int $idestado
 * @property string|null $contratonumero
 * @property float|null $cobropactado
 * @property int|null $duracioncontrato
 * @property string|null $fechainicio
 *
 * @property Cobros[] $cobros
 * @property Clientes $idcliente0
 * @property Estado $idestado0
 * @property Fechacorte $idfechacorte0
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
            [['mesesnopagados', 'idcliente', 'idservicio', 'idfechacorte', 'idestado', 'duracioncontrato'], 'integer'],
            [['subtotal', 'cobropactado'], 'number'],
            [['idcliente', 'idservicio', 'idfechacorte', 'idestado'], 'required'],
            [['fechainicio'], 'safe'],
            [['contratonumero'], 'string', 'max' => 45],
            [['idcliente'], 'unique'],
            [['idservicio'], 'unique'],
            [['idcliente', 'idservicio'], 'unique', 'targetAttribute' => ['idcliente', 'idservicio']],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['idestado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['idestado' => 'idestado']],
            [['idfechacorte'], 'exist', 'skipOnError' => true, 'targetClass' => Fechacorte::className(), 'targetAttribute' => ['idfechacorte' => 'idfechacorte']],
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
            'idfechacorte' => 'Idfechacorte',
            'idestado' => 'Idestado',
            'contratonumero' => 'Contratonumero',
            'cobropactado' => 'Cobropactado',
            'duracioncontrato' => 'Duracioncontrato',
            'fechainicio' => 'Fechainicio',
        ];
    }

    /**
     * Gets query for [[Cobros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCobros()
    {
        return $this->hasMany(Cobros::className(), ['idcliente' => 'idcliente', 'idservicio' => 'idservicio']);
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
     * Gets query for [[Idestado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdestado0()
    {
        return $this->hasOne(Estado::className(), ['idestado' => 'idestado']);
    }

    /**
     * Gets query for [[Idfechacorte0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdfechacorte0()
    {
        return $this->hasOne(Fechacorte::className(), ['idfechacorte' => 'idfechacorte']);
    }

    /**
     * Gets query for [[Idservicio0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdservicio0()
    {
        return $this->hasOne(Servicios::className(), ['idservicio' => 'idservicio']);
    }

    /**
     * Gets query for [[Trabajospendientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajospendientes()
    {
        return $this->hasMany(Trabajospendientes::className(), ['servicioscontratados_idcliente' => 'idcliente', 'servicioscontratados_idservicio' => 'idservicio']);
    }
}
