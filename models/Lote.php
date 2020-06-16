<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lote".
 *
 * @property int $idlote
 * @property string|null $fecha
 * @property float|null $totalcobrado
 * @property string|null $anyomes
 * @property string|null $zona
 *
 * @property Cobros[] $cobros
 */
class Lote extends \yii\db\ActiveRecord
{
    public  $_cobros;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lote';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha','zona'], 'safe'],
            [['totalcobrado'], 'number'],
            [['anyomes'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idlote' => 'Id lote',
            'fecha' => 'Fecha',
            'totalcobrado' => 'Total cobrado',
            'anyomes' => 'Año y mes',
            'zona' => 'Zona agrupación',
        ];
    }

    /**
     * Gets query for [[Cobros]].
     *
     * @return \yii\db\ActiveQuery|CobrosQuery
     */
    public function getCobros()
    {
        return $this->hasMany(Cobros::className(), ['lote_idlote' => 'idlote']);
    }

    /**
     * {@inheritdoc}
     * @return LoteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LoteQuery(get_called_class());
    }

    public function setCobros($zona, $anyomes){
        $this->cobros = Cobros::getCobros($zona, $anyomes);
    }
}
