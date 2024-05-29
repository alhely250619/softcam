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
    public $buscarFolios;
    public $buscarConceptos;
    public $buscarMetodos;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'VentasEncabezado_Id', 'Conceptos_Id', 'MetodoPago_Id'], 'integer'],
            [['Monto'], 'number'],
            [['buscarFolios'], 'safe'],
            [['buscarConceptos'], 'safe'],
            [['buscarMetodos'], 'safe'],
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

        $query->joinWith(['ventasEncabezado' => function ($query) {
            $query->andFilterWhere(['like', 'ventasEncabezado.Folio', $this->buscarFolios]);
        }]);
        $query->joinWith(['ventasEncabezado' => function ($query) {
            $query->andFilterWhere(['like', 'ventasEncabezado.Conceptos', $this->buscarConceptos]);
        }]);
        $query->joinWith(['metodoPago' => function ($query) {
            $query->andFilterWhere(['like', 'metodoPago.Nombre', $this->buscarMetodos]);
        }]);

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
            'Conceptos_Id' => $this->Conceptos_Id,
            'FechaHora_create' => $this->FechaHora_create,
            'MetodoPago_Id' => $this->MetodoPago_Id,
            'FechaHora_update' => $this->FechaHora_update,
        ]);
        
        // Agrega una condición para que 'VentasEncabezado_Id' no sea null
        $query->andWhere(['IS NOT', 'VentasEncabezado_Id', null]);
        
        // Otros filtros y condiciones pueden ir aquí

        return $dataProvider;
    }
}
