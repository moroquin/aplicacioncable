<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cobros;

/**
 * CobrosSearch represents the model behind the search form of `app\models\Cobros`.
 */
class CobrosSearch extends Cobros
{
    public $primernombre;
    public $segundonombre;
    public $primerapelldio;
    public $segundoapellido;

     
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcobro', 'idempleado', 'idservicioscontratados', 'mesesporcobrar','mesespagados'], 'integer'],
            [['numerofactura', 'fecha', 'tipo', 'factura', 'contrasenya', 'zona', 'anyomes','primernombre',  'segundonombre', 'primerapelldio', 'segundoapellido', ], 'safe'],
            [['totalporcobrar', 'totalcobrado'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Cobros::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idcobro' => $this->idcobro,
            'idempleado' => $this->idempleado,
            'fecha' => $this->fecha,
            'mesesporcobrar' => $this->mesesporcobrar,
            'mesespagados' => $this->mesespagados,
            'idservicioscontratados' => $this->idservicioscontratados,
        ]);

        $query->andFilterWhere(['like', 'numerofactura', $this->numerofactura])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'factura', $this->factura])
            ->andFilterWhere(['like', 'contrasenya', $this->contrasenya])

         

            ->andFilterWhere(['like', 'zona', $this->zona])
            ->andFilterWhere(['like', 'anyomes', $this->anyomes]);
            

            

        return $dataProvider;
    }
}
