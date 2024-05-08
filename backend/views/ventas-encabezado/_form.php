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
    ->select(['alumnos.id', 'alumnos.nombre','alumnos.apellido','alumnos.matricula'])
    ->from('ventasencabezado')
    ->join('RIGHT JOIN', 'alumnos', 'alumnos.id = ventasencabezado.alumnos_id'); 

// Ejecutar la consulta y obtener los datos
$data = $query->all();

// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out = [];
foreach ($data as $d) {
    $out[$d['id']]  = $d['matricula'];
}


// Consultas para traer conceptos de pago
$query = (new Query())
->select(['productos.id', 'productos.nombre']) // La lista de columnas se pasa como un array
->from('ventasdetalle')
->join('RIGHT JOIN', 'productos', 'productos.id = ventasdetalle.productos_id'); 
// Ejecutar la consulta y obtener los datos
$data = $query->all();
// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$outPagos = [];
foreach ($data as $d) {
    $outPagos[$d['id']]  = $d['nombre'];
}

?>

<div class="ventas-encabezado-form" >

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Alumnos_Id')->dropDownList($out) ?>

    <?= $form->field($model, 'Estatus')->textInput(['maxlength' => true]) ?>


</div>


<div class="ventas-detalle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Cantidad')->textInput() ?>

    <?= $form->field($model, 'Subtotal')->textInput() ?>

    <?= $form->field($model, 'VentasEncabezado_Id')->textInput() ?>

    <?= $form->field($model, 'Productos_id')->dropDownList($outPagos,['prompt' => 'Select...']) ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- Aquí se incluye AngularJS y se define el controlador AngularJS -->
<?php
$this->registerJsFile('@web/assets/angular-1.5.7/angular.min.js', ['position' => \yii\web\View::POS_HEAD]);
?>
<?php foreach ($model->ventasdetalles as $detalle): ?>
    <p>Producto: <?= $detalle->producto ?></p>
    <p>Cantidad: <?= $detalle->cantidad ?></p>
    <p>Precio: <?= $detalle->precio ?></p>
    <!-- Otros detalles de ventas -->
<?php endforeach; ?>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <br>
            <button type="button" class="btn btn-sm btn-primary">Agregar producto</button>
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<div>
    <?= $form->field($model, 'Total')->textInput() ?>
    <div class="form-group" >
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>