<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagos".
 *
 * @property int $Id
 * @property string $Concepto
 * @property float $Monto
 * @property string $MetodoPago
 * @property int $VentasEncabezado_Id
 *
 * @property Ventasencabezado $ventasEncabezado
 */
class Pagos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pagos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Concepto', 'Monto', 'MetodoPago', 'VentasEncabezado_Id'], 'required'],
            [['Monto'], 'number'],
            [['VentasEncabezado_Id'], 'integer'],
            [['Concepto'], 'string', 'max' => 50],
            [['MetodoPago'], 'string', 'max' => 15],
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
            'Concepto' => 'Concepto',
            'Monto' => 'Monto',
            'MetodoPago' => 'Metodo Pago',
            'VentasEncabezado_Id' => 'Ventas Encabezado ID',
        ];
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
