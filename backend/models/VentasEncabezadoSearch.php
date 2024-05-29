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
    public $alumnoNombre;
    public $estatus;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'Alumnos_Id'], 'integer'],
            [['Id', 'EstatusEncabezado_Id'], 'integer'],
            [['alumnoNombre'], 'safe'],
            [['estatus'], 'safe'],
            [['Folio'],'number'],
            [['Fecha_create', 'Fecha_update'], 'safe'],
            [['Total'], 'number'],
            [['Nota'], 'safe'],
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

        // Añadir relación con la tabla alumnos
        $query->joinWith(['alumnos' => function ($query) {
            $query->andFilterWhere(['like', 'alumnos.Nombre', $this->alumnoNombre])
                ->orFilterWhere(['like', 'alumnos.Apellido', $this->alumnoNombre]);
        }]);

        $query->joinWith(['estatusencabezado' => function ($query) {
            $query->andFilterWhere(['like', 'estatusencabezado.Nombre', $this->estatus]);
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
            'Fecha_create' => $this->Fecha_create,
            'Folio'=>$this->Folio,
            'Total' => $this->Total,
            'Nota' => $this->Nota,
            'Alumnos_Id' => $this->Alumnos_Id,
            'EstatusEncabezado_Id' => $this->EstatusEncabezado_Id,
            'Fecha_update' => $this->Fecha_update,
        ]);

        $query->andFilterWhere(['like', 'EstatusEncabezado_Id', $this->EstatusEncabezado_Id]);

        return $dataProvider;
    }
}
