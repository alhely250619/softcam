<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tallas".
 *
 * @property int $Id
 * @property string $Nombre
 *
 * @property Productos[] $productos
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
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::class, ['Tallas_Id' => 'Id']);
    }
}
