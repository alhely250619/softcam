<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\VentasEncabezado $model */
/** @var yii\widgets\ActiveForm $form */
use yii\db\Query;
use yii\helpers\Json;

// Consultas para traer alumnos 
$query = (new Query())
->select(['alumnos.id', 'alumnos.nombre','alumnos.apellido','alumnos.matricula']) // La lista de columnas se pasa como un array
->from('ventasencabezado')
->join('RIGHT JOIN', 'alumnos', 'alumnos.id = ventasencabezado.alumnos_id'); 
// Ejecutar la consulta y obtener los datos
$data = $query->all();
// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out = [];
foreach ($data as $d) {
    $out[$d['id']]  = $d['matricula'];
}

?>

<div class="ventas-encabezado-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'Fecha_create')->textInput() ?> -->

    <?= $form->field($model, 'Total')->textInput() ?>

    <?= $form->field($model, 'Estatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Alumnos_Id')->dropDownList($out) ?>

    <!-- <?= $form->field($model, 'Fecha_update')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
