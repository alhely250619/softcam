<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tallas".
 *
 * @property int $Id
 * @property string $Nombre
 *
 * @property Ventasdetalle[] $ventasdetalles
 */
class Tallas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tallas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nombre'], 'required'],
            [['Nombre'], 'string', 'max' => 4],
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

    /**
     * Gets query for [[Ventasdetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentasdetalles()
    {
        return $this->hasMany(Ventasdetalle::class, ['Tallas_Id' => 'Id']);
    }
}
