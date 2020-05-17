<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Servicioscontratados;

/**
 * ServicioscontratadosSearch represents the model behind the search form of `app\models\Servicioscontratados`.
 */
class ServicioscontratadosSearch extends Servicioscontratados
{

    public $primernombre;
    public $segundonombre;
    public $primerapelldio;
    public $segundoapellido;
    public $correlativo;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mesesnopagados', 'idcliente', 'idservicio', 'duracioncontrato', 'idservicioscontratados'], 'integer'],
            [['subtotal', 'cobropactado'], 'number'],
            [['contratonumero', 'fechainicio', 'nombreestado', 'primernombre', 'correlativo', 'segundonombre', 'primerapelldio', 'segundoapellido', 'corte'], 'safe'],
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
        //$query = Servicioscontratados::find();

        $query = Servicioscontratados::find()
            ->joinWith(['clientes']);
            

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
            'mesesnopagados' => $this->mesesnopagados,
       //     'subtotal' => $this->subtotal,
            'idcliente' => $this->idcliente,
            'idservicio' => $this->idservicio,
            'cobropactado' => $this->cobropactado,
            'duracioncontrato' => $this->duracioncontrato,
            'fechainicio' => $this->fechainicio,
            'idservicioscontratados' => $this->idservicioscontratados,
        ]);

        $query->andFilterWhere(['like', 'contratonumero', $this->contratonumero])
            ->andFilterWhere(['like', 'nombreestado', $this->nombreestado])


            ->andFilterWhere(['like', 'clientes.primernombre', $this->primernombre])
            ->andFilterWhere(['like', 'clientes.segundonombre', $this->segundonombre])
            ->andFilterWhere(['like', 'clientes.primerapelldio', $this->primerapelldio])
            ->andFilterWhere(['like', 'clientes.segundoapellido', $this->segundoapellido])
            ->andFilterWhere(['like', 'clientes.correlativo', $this->correlativo])

            

            ->andFilterWhere(['like', 'corte', $this->corte]);

        return $dataProvider;
    }
}
