<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ventasdetalle".
 *
 * @property int $Id
 * @property int $Cantidad
 * @property float $Subtotal
 * @property int $VentasEncabezado_Id
 * @property int $Productos_id
 *
 * @property Productos $productos
 * @property Ventasencabezado $ventasEncabezado
 */
class Ventasdetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ventasdetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Cantidad', 'Subtotal', 'VentasEncabezado_Id', 'Productos_id'], 'required'],
            [['Cantidad', 'VentasEncabezado_Id', 'Productos_id'], 'integer'],
            [['Subtotal'], 'number'],
            [['Productos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['Productos_id' => 'Id']],
            [['VentasEncabezado_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Ventasencabezado::class, 'targetAttribute' => ['VentasEncabezado_Id' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Cantidad' => 'Cantidad',
            'Subtotal' => 'Subtotal',
            'VentasEncabezado_Id' => 'Ventas Encabezado ID',
            'Productos_id' => 'Productos ID',
        ];
    }

    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasOne(Productos::class, ['Id' => 'Productos_id']);
    }

    /**
     * Gets query for [[VentasEncabezado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentasEncabezado()
    {
        return $this->hasOne(Ventasencabezado::class, ['Id' => 'VentasEncabezado_Id']);
    }
}
