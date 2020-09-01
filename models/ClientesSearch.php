<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Clientes;

/**
 * ClientesSearch represents the model behind the search form of `app\models\Clientes`.
 */
class ClientesSearch extends Clientes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcliente'], 'integer'],
            [['correlativo', 'primernombre', 'segundonombre', 'primerapelldio', 'segundoapellido', 'direccion', 'dpi', 'referencias', 'telefono1', 'telefono2', 'nit', 'nombrezona'], 'safe'],
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
     * @param boolean $agregarcliente indica si debemos agregar el cliente 1 que indica un nuevo cliente
     *
     * @return ActiveDataProvider
     */
    public function search($params, $agregarcliente)
    {
        $query = Clientes::find();

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
            'idcliente' => $this->idcliente,
        ]);
        if (!$agregarcliente)
            $query->andFilterWhere([
                '<>','idcliente','1',
            ]);

        $query->andFilterWhere(['like', 'correlativo', $this->correlativo])
            ->andFilterWhere(['like', 'primernombre', $this->primernombre])
            ->andFilterWhere(['like', 'segundonombre', $this->segundonombre])
            ->andFilterWhere(['like', 'primerapelldio', $this->primerapelldio])
            ->andFilterWhere(['like', 'segundoapellido', $this->segundoapellido])
            //->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'dpi', $this->dpi])
            //->andFilterWhere(['like', 'referencias', $this->referencias])
            //->andFilterWhere(['like', 'telefono1', $this->telefono1])
            //->andFilterWhere(['like', 'telefono2', $this->telefono2])
            ->andFilterWhere(['like', 'nit', $this->nit])
            ->andFilterWhere(['like', 'nombrezona', $this->nombrezona]);

        return $dataProvider;
    }
}
