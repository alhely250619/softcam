<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pagos $model */
/** @var yii\widgets\ActiveForm $form */

use yii\db\Query;
use yii\helpers\Json;

// Definir la consulta para obtener todos los encabezados de ventas con sus fechas
$query = (new Query())
->select(['conceptos.id', 'conceptos.nombre']) // La lista de columnas se pasa como un array
->from('pagos')
->join('RIGHT JOIN', 'conceptos', 'conceptos.id = pagos.conceptos_id'); 


// Ejecutar la consulta y obtener los datos
$data = $query->all();

// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out = [];
foreach ($data as $d) {
    $out[$d['id']] = $d['nombre'];
}

?>

<div class="pagos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Monto')->textInput() ?>

    <?= $form->field($model, 'VentasEncabezado_Id')->textInput() ?>

    <?= $form->field($model, 'Conceptos_Id')->textInput() ?>

    <?= $form->field($model, 'FechaHora_creación')->textInput() ?>

    <?= $form->field($model, 'MetodoPago_Id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
