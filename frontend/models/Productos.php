<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $Id
 * @property string $Nombre
 * @property float $Precio
 * @property string $Genero
 *
 * @property Ventasdetalle[] $ventasdetalles
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nombre', 'Precio', 'Genero'], 'required'],
            [['Precio'], 'number'],
            [['Nombre'], 'string', 'max' => 45],
            [['Genero'], 'string', 'max' => 1],
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
            'Precio' => 'Precio',
            'Genero' => 'Genero',
        ];
    }

    /**
     * Gets query for [[Ventasdetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentasdetalles()
    {
        return $this->hasMany(Ventasdetalle::class, ['Productos_id' => 'Id']);
    }
}
