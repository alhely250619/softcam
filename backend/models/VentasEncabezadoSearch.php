<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VentasEncabezado;

/**
 * VentasEncabezadoSearch represents the model behind the search form of `app\models\VentasEncabezado`.
 */
class VentasEncabezadoSearch extends VentasEncabezado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'Alumnos_Id'], 'integer'],
            [['Fecha_create', 'Estatus', 'Fecha_update'], 'safe'],
            [['Total'], 'number'],
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
        $query = VentasEncabezado::find();

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
            'Fecha_create' => $this->Fecha_create,
            'Total' => $this->Total,
            'Alumnos_Id' => $this->Alumnos_Id,
            'Fecha_update' => $this->Fecha_update,
        ]);

        $query->andFilterWhere(['like', 'Estatus', $this->Estatus]);

        return $dataProvider;
    }
}
