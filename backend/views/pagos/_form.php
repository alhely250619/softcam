<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pagos $model */
/** @var yii\widgets\ActiveForm $form */
use yii\db\Query;
use yii\helpers\Json;
use yii\helpers\Url;

$query = (new Query())
    ->select(['ventasencabezado.id', 'ventasencabezado.folio'])
    ->from('ventasencabezado'); 

// Ejecutar la consulta y obtener los datos
$outFolio = $query->all();

// Consultas para traer conceptos de pago
$query = (new Query())
->select(['conceptos.id', 'conceptos.nombre']) // La lista de columnas se pasa como un array
->from('pagos')
->join('RIGHT JOIN', 'conceptos', 'conceptos.id = pagos.conceptos_id'); 
// Ejecutar la consulta y obtener los datos
$data = $query->all();
// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out = [];
$out[NULL]  = 'Seleccione concepto de pago';
foreach ($data as $d) {
    $out[$d['id']] = $d['nombre'];
}

// Consultas para traer metodo de pago
$query_metodo = (new Query())
->select(['metodopago.id', 'metodopago.nombre']) // La lista de columnas se pasa como un array
->from('metodopago');

// Ejecutar la consulta y obtener los datos
$data_metodo = $query_metodo->all();
// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out_metodo = [];
$out_metodo[NULL]  = 'Seleccione método';
foreach ($data_metodo as $d) {
    $out_metodo[$d['id']] = $d['nombre'];
}
?>

<div class="pagos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->bandera == 1): ?>
        <div class="site-search">
        
        <?= $form->field($model, 'VentasEncabezado_Id')->textInput(['class' => 'form-control mb-0 d-none', 'id' => 'folio-pagos', 'readonly' => true]) ?>


        <?= $form->field($model, 'VentasEncabezado_Txt')->textInput(['class'=>'form-control mt-0','list' => 'listaventas', 'id' => 'ventastxt']) ?>

        <datalist id="listaventas">
            <?php foreach ($outFolio as $ventas): ?>
                <option data-id="<?= $ventas['id'] ?>" value="<?= $ventas['folio']?>"></option>
            <?php endforeach; ?>
        </datalist>

        <script>
            document.getElementById('ventastxt').addEventListener('input', obtenerIdVenta);
            function obtenerIdVenta() {
                const input2 = document.getElementById('ventastxt');
                const datalist2 = document.getElementById('listaventas');
                const valorSeleccionado2 = input2.value;
                const inputId2 = document.getElementById('folio-pagos');

                // Buscar el option correspondiente en el datalist
                const opciones2 = datalist2.querySelectorAll('option');
                let idVenta2 = null;

                opciones2.forEach(option => {
                    console.log(option);
                    if (option.value === valorSeleccionado2) {
                        idVenta2 = option.getAttribute('data-id');
                    }
                });

                if (idVenta2) {
                    inputId2.value = idVenta2;
                } else {
                    inputId2.value = '';
                }
            }
        </script>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'Conceptos_Id')->dropDownList($out) ?>

    <?= $form->field($model, 'MetodoPago_Id')->dropDownList($out_metodo) ?>
    
    <?= $form->field($model, 'Monto')->textInput() ?>

    <!-- <?= $form->field($model, 'FechaHora_create')->textInput() ?> -->

    <!-- <?= $form->field($model, 'FechaHora_update')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <span id="result"></span>
    <?php ActiveForm::end(); ?>

</div>
<style>
    .hidden-field {
    display: none;
    }
</style>
