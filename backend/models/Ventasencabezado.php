<?php

namespace app\models;
use yii\behaviors\TimestampBehavior; 
use yii\behaviors\BlameableBehavior; 
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use Yii;
use yii\db\Query;


/**
 * This is the model class for table "ventasencabezado".
 *
 * @property int $Id
 * @property string $Fecha_create
 * @property float $Total
 * @property float $IVA
 * @property string $Nota
 * @property string $Estatus
 * @property int $Alumnos_Id
 * @property string $Folio
 * * @property int $EstatusEncabezado_Id
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
    public $Alumnos_Txt; 
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
            [['Total', 'Alumnos_Id',], 'required'],
            [['EstatusEncabezado_Id'], 'required'],
            [['Fecha_create', 'Fecha_update'], 'safe'],
            [['Folio'], 'safe'],
            [['Total'], 'number'],
            [['Nota'], 'safe'],
            [['Alumnos_Id'], 'integer'],
            [['Alumnos_Txt'], 'safe'],
            [['EstatusEncabezado_Id'], 'integer'],
            [['Alumnos_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['Alumnos_Id' => 'Id']],
            [['EstatusEncabezado_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatusencabezado::class, 'targetAttribute' => ['EstatusEncabezado_Id' => 'Id']],
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
            'Folio'=>'Folio',
            'Total' => 'Total',
            'Nota' => 'Nota',
            'Alumnos_Id' => '',
            'Alumnos_Txt' => 'Alumno',
            'EstatusEncabezado_Id' => 'Estatus',
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
        return Pagos::find()
        ->orWhere(['VentasEncabezado_Id' => null]) // Incluir registros con VentasEncabezado_Id igual a null
        ->orWhere(['VentasEncabezado_Id' => $this->Id]) // Incluir registros relacionados con el ID actual
        ->all();
    }

    /**
     * Gets query for [[Ventasdetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentasdetalles()
    {
        return Ventasdetalle::find()
        ->orWhere(['VentasEncabezado_Id' => null]) // Incluir registros con VentasEncabezado_Id igual a null
        ->orWhere(['VentasEncabezado_Id' => $this->Id]) // Incluir registros relacionados con el ID actual
        ->all();
    }
    public static function getNextFolio()
    {
        $query = (new Query())
            ->select([
                'Folio' => 'LPAD(CAST(IFNULL(MAX(CAST(Folio AS UNSIGNED)), 0) + 1 AS CHAR), 4, \'0\')'
            ])
            ->from('ventasencabezado');

        $result = $query->one();
        return $result ? $result['Folio'] : null;
    }

    public function getEstatusencabezado()
    {
        return $this->hasOne(Estatusencabezado::class, ['Id' => 'EstatusEncabezado_Id']);
    }
    
    public static function getVentasDetalleNull()
    {
        return Ventasdetalle::find()->where(['VentasEncabezado_Id' => null])->all();
    }
    public static function getPagosNull()
    {
        return Pagos::find()->where(['VentasEncabezado_Id' => null])->all();
    }

    public static function getAlumnoById($Id)
    {
        return Alumnos::find()->where(['Id' => $Id])->one();
    }
}

