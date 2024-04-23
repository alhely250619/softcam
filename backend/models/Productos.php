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
 * @property int $Tallas_Id
 * @property int $CategoriaProductos_Id
 *
 * @property Categoriaproductos $categoriaProductos
 * @property Tallas $tallas
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
            [['Nombre', 'Precio', 'Genero', 'Tallas_Id', 'CategoriaProductos_Id'], 'required'],
            [['Precio'], 'number'],
            [['Tallas_Id', 'CategoriaProductos_Id'], 'integer'],
            [['Nombre'], 'string', 'max' => 45],
            [['Genero'], 'string', 'max' => 1],
            [['CategoriaProductos_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoriaproductos::class, 'targetAttribute' => ['CategoriaProductos_Id' => 'Id']],
            [['Tallas_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Tallas::class, 'targetAttribute' => ['Tallas_Id' => 'Id']],
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
            'Tallas_Id' => 'Tallas ID',
            'CategoriaProductos_Id' => 'Categoria Productos ID',
        ];
    }

    /**
     * Gets query for [[CategoriaProductos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaProductos()
    {
        return $this->hasOne(Categoriaproductos::class, ['Id' => 'CategoriaProductos_Id']);
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
     * Gets query for [[Ventasdetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentasdetalles()
    {
        return $this->hasMany(Ventasdetalle::class, ['Productos_id' => 'Id']);
    }
}