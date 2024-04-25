<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pagos;

/**
 * PagosSearch represents the model behind the search form of `app\models\Pagos`.
 */
class PagosSearch extends Pagos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'VentasEncabezado_Id', 'Conceptos_Id', 'MetodoPago_Id'], 'integer'],
            [['Monto'], 'number'],
            [['FechaHora_create', 'FechaHora_update'], 'safe'],
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
        $query = Pagos::find();

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
            'Id' => $this->Id,
            'Monto' => $this->Monto,
            'VentasEncabezado_Id' => $this->VentasEncabezado_Id,
            'Conceptos_Id' => $this->Conceptos_Id,
            'FechaHora_create' => $this->FechaHora_create,
            'MetodoPago_Id' => $this->MetodoPago_Id,
            'FechaHora_update' => $this->FechaHora_update,
        ]);

        return $dataProvider;
    }
}
