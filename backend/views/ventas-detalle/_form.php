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
->select(['productos.id', 'productos.nombre', 'productos.precio']) // La lista de columnas se pasa como un array
->from('ventasdetalle')
->join('RIGHT JOIN', 'productos', 'productos.id = ventasdetalle.productos_id'); 
// Ejecutar la consulta y obtener los datos
$data = $query->all();
// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out = [];
$out[NULL]  = 'Seleccione producto';
foreach ($data as $d) {
    $out[$d['id']]  = $d['nombre'];
}

$producto_json = json_encode($data);
?>

<div class="ventas-detalle-form">

    <?php $form = ActiveForm::begin(); ?>

    <div style="display: none;">
        <?= $form->field($model, 'VentasEncabezado_Id')->textInput() ?>
    </div>

    <?= $form->field($model, 'Productos_id')->dropDownList($out, [
        'id' => 'Productos_id', // Agregar un ID para identificar el dropdown
    ]) ?>

    <?= $form->field($model, 'Cantidad')->textInput(['id' => 'Cantidad']) ?>
    <!--<?= $form->field($model, 'Subtotal')->textInput(['id' => 'Subtotal', 'type' => 'number', 'disabled' => true]) ?>-->
    </br> 
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <span id="result"></span>
    <?php ActiveForm::end(); ?>
</div>
<!--<script>
    var productos = <?= $producto_json ?>;

    function calcularTotal() {
        var cantidad = parseInt($("#Cantidad").val());
        var producto = productos.find(element => element.id = parseInt($("#Productos_id").val()));
        var precio = parseFloat(producto.precio);
        var subtotal = cantidad * precio;
        $("#Subtotal").val(subtotal);
    }
    Cantidad.oninput = function() {
        var cantidad = parseInt($("#Cantidad").val());
        var producto = productos.find(element => element.id = parseInt($("#Productos_id").val()));
        var precio = parseFloat(producto.precio);
        var subtotal = cantidad * precio;
        $("#Subtotal").val(subtotal);
    };
</script>--<
