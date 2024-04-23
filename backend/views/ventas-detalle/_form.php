<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\VentasDetalle $model */
/** @var yii\widgets\ActiveForm $form */

use yii\db\Query;
use yii\helpers\Json;

// Consultas para traer conceptos de pago
$query = (new Query())
->select(['productos.id', 'productos.nombre']) // La lista de columnas se pasa como un array
->from('ventasdetalle')
->join('RIGHT JOIN', 'productos', 'productos.id = ventasdetalle.productos_id'); 
// Ejecutar la consulta y obtener los datos
$data = $query->all();
// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out = [];
foreach ($data as $d) {
    $out[$d['id']]  = $d['nombre'];
}
?>

<div class="ventas-detalle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Cantidad')->textInput() ?>

    <?= $form->field($model, 'Subtotal')->textInput() ?>

    <?= $form->field($model, 'VentasEncabezado_Id')->textInput() ?>

    <?= $form->field($model, 'Productos_id')->dropDownList($out) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
