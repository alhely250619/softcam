<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ventasdetalle".
 *
 * @property int $Id
 * @property int $Cantidad
 * @property float $PrecioProducto
 * @property float $Total
 * @property int $VentasEncabezado_Id
 * @property int $Productos_id
 * @property int $Tallas_Id
 *
 * @property Productos $productos
 * @property Tallas $tallas
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
            [['Cantidad', 'PrecioProducto', 'Total', 'VentasEncabezado_Id', 'Productos_id', 'Tallas_Id'], 'required'],
            [['Cantidad', 'VentasEncabezado_Id', 'Productos_id', 'Tallas_Id'], 'integer'],
            [['PrecioProducto', 'Total'], 'number'],
            [['Productos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['Productos_id' => 'Id']],
            [['Tallas_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Tallas::class, 'targetAttribute' => ['Tallas_Id' => 'Id']],
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
            'PrecioProducto' => 'Precio Producto',
            'Total' => 'Total',
            'VentasEncabezado_Id' => 'Ventas Encabezado ID',
            'Productos_id' => 'Productos ID',
            'Tallas_Id' => 'Tallas ID',
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
     * Gets query for [[Tallas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTallas()
    {
        return $this->hasOne(Tallas::class, ['Id' => 'Tallas_Id']);
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
