<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagos".
 *
 * @property int $Id
 * @property float $Monto
 * @property string $MetodoPago
 * @property int $VentasEncabezado_Id
 * @property int $Conceptos_Id
 *
 * @property Conceptos $conceptos
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
            [['Monto', 'MetodoPago', 'VentasEncabezado_Id', 'Conceptos_Id'], 'required'],
            [['Monto'], 'number'],
            [['VentasEncabezado_Id', 'Conceptos_Id'], 'integer'],
            [['MetodoPago'], 'string', 'max' => 15],
            [['Conceptos_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Conceptos::class, 'targetAttribute' => ['Conceptos_Id' => 'Id']],
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
            'Monto' => 'Monto',
            'MetodoPago' => 'Metodo Pago',
            'VentasEncabezado_Id' => 'Ventas Encabezado ID',
            'Conceptos_Id' => 'Conceptos ID',
        ];
    }

    /**
     * Gets query for [[Conceptos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConceptos()
    {
        return $this->hasOne(Conceptos::class, ['Id' => 'Conceptos_Id']);
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
