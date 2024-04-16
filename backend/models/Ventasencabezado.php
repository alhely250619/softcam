<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ventasencabezado".
 *
 * @property int $Id
 * @property string $Fecha
 * @property float|null $Total
 * @property string $Estatus
 * @property int $Alumnos_Id
 *
 * @property Alumnos $alumnos
 * @property Pagos[] $pagos
 * @property Ventasdetalle[] $ventasdetalles
 */
class Ventasencabezado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ventasencabezado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'Fecha', 'Estatus', 'Alumnos_Id'], 'required'],
            [['Id', 'Alumnos_Id'], 'integer'],
            [['Fecha'], 'safe'],
            [['Total'], 'number'],
            [['Estatus'], 'string', 'max' => 1],
            [['Id'], 'unique'],
            [['Alumnos_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['Alumnos_Id' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Fecha' => 'Fecha',
            'Total' => 'Total',
            'Estatus' => 'Estatus',
            'Alumnos_Id' => 'Alumnos ID',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasOne(Alumnos::class, ['Id' => 'Alumnos_Id']);
    }

    /**
     * Gets query for [[Pagos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pagos::class, ['VentasEncabezado_Id' => 'Id']);
    }

    /**
     * Gets query for [[Ventasdetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentasdetalles()
    {
        return $this->hasMany(Ventasdetalle::class, ['VentasEncabezado_Id' => 'Id']);
    }
}
