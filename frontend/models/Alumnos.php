<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alumnos".
 *
 * @property int $Id
 * @property int $Matricula
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Sexo m-mujer h-hombre
 *
 * @property Ventasencabezado[] $ventasencabezados
 */
class Alumnos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumnos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Matricula', 'Nombre', 'Apellido', 'Sexo'], 'required'],
            [['Matricula'], 'integer'],
            [['Nombre', 'Apellido'], 'string', 'max' => 30],
            [['Sexo'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Matricula' => 'Matricula',
            'Nombre' => 'Nombre',
            'Apellido' => 'Apellido',
            'Sexo' => 'Sexo',
        ];
    }

    /**
     * Gets query for [[Ventasencabezados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentasencabezados()
    {
        return $this->hasMany(Ventasencabezado::class, ['Alumnos_Id' => 'Id']);
    }
}
