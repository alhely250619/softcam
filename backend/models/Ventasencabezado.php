<?php

namespace app\models;
use yii\behaviors\TimestampBehavior; 
use yii\behaviors\BlameableBehavior; 
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "ventasencabezado".
 *
 * @property int $Id
 * @property string $Fecha_create
 * @property float $Total
 * @property string $Estatus
 * @property int $Alumnos_Id
 * @property string $Fecha_update
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
            [['Total', 'Estatus', 'Alumnos_Id'], 'required'],
            [['Fecha_create', 'Fecha_update'], 'safe'],
            [['Total'], 'number'],
            [['Alumnos_Id'], 'integer'],
            [['Estatus'], 'string', 'max' => 1],
            [['Alumnos_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['Alumnos_Id' => 'Id']],
        ];
    }
    public function behaviors() {
        return [
            [ 
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'Fecha_create', 
            'updatedAtAttribute' => 'Fecha_update', 
            'value' => new Expression('NOW()'), ], 
            
        ]; 
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Fecha_create' => 'Fecha Create',
            'Total' => 'Total',
            'Estatus' => 'Estatus',
            'Alumnos_Id' => 'Alumnos ID',
            'Fecha_update' => 'Fecha Update',
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
