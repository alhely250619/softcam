<?php

namespace app\models;
use yii\behaviors\TimestampBehavior; 
use yii\behaviors\BlameableBehavior; 
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "pagos".
 *
 * @property int $Id
 * @property float $Monto
 * @property int $VentasEncabezado_Id
 * @property int $Conceptos_Id
 * @property string $FechaHora_create
 * @property int $MetodoPago_Id
 * @property string $FechaHora_update
 * 
 * @property Conceptos $conceptos
 * @property Metodopago $metodoPago
 * @property Ventasencabezado $ventasEncabezado
 */
class Pagos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $VentasEncabezado_Txt;
    public $bandera;
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
            [['Monto', 'Conceptos_Id', 'MetodoPago_Id'], 'required'],
            [['Monto','VentasEncabezado_Id'], 'number'],
            [['VentasEncabezado_Txt'], 'safe'],
            [['bandera'], 'integer'],
            [['VentasEncabezado_Id', 'Conceptos_Id', 'MetodoPago_Id'], 'integer'],
            [['FechaHora_create', 'FechaHora_update'], 'safe'],
            [['Conceptos_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Conceptos::class, 'targetAttribute' => ['Conceptos_Id' => 'Id']],
            [['MetodoPago_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Metodopago::class, 'targetAttribute' => ['MetodoPago_Id' => 'Id']],
            [['VentasEncabezado_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Ventasencabezado::class, 'targetAttribute' => ['VentasEncabezado_Id' => 'Id']],
        ];
    }
    public function behaviors()
    {
        return [
        [
        'class' => TimestampBehavior::className(),
        'createdAtAttribute' => 'FechaHora_create',
        'updatedAtAttribute' => 'FechaHora_update', 
        'value' => new Expression('NOW()'),
        ],
        
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
            'VentasEncabezado_Id' => '',
            'VentasEncabezado_Txt' => 'Venta',
            'bandera' => '',
            'Conceptos_Id' => 'Concepto de pago:',
            'FechaHora_create' => 'Fecha de creación:',
            'MetodoPago_Id' => 'Metodo de Pago: ',
            'FechaHora_update' => 'Fecha de actualización:',
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
     * Gets query for [[MetodoPago]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetodoPago()
    {
        return $this->hasOne(Metodopago::class, ['Id' => 'MetodoPago_Id']);
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
