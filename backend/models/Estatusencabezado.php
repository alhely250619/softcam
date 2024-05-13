<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estatusencabezado".
 *
 * @property int $Id
 * @property string $Nombre
 *
 * @property Ventasencabezado[] $ventasencabezados
 */
class Estatusencabezado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estatusencabezado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nombre'], 'required'],
            [['Nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Nombre' => 'Nombre',
        ];
    }
}
