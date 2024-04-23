<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Productos $model */
/** @var yii\widgets\ActiveForm $form */
use yii\db\Query;
use yii\helpers\Json;

// Consultas para traer conceptos de pago
$query = (new Query())
->select(['CP.id', 'CP.nombre']) // La lista de columnas se pasa como un array
->from('productos')
->join('RIGHT JOIN', 'categoriaproductos CP', 'CP.id = productos.categoriaproductos_id'); 
// Ejecutar la consulta y obtener los datos
$data = $query->all();
// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out = [];
foreach ($data as $d) {
    $out[$d['id']]  = $d['nombre'];
}

$query_genero = (new Query())
->select(['genero.id', 'genero.nombre']) // La lista de columnas se pasa como un array
->from('productos')
->join('RIGHT JOIN', 'genero', 'genero.id = productos.genero_id'); 
// Ejecutar la consulta y obtener los datos
$data = $query_genero->all();
// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out_genero = [];
foreach ($data as $d) {
    $out_genero[$d['id']]  = $d['nombre'];
}

$query_tallas = (new Query())
->select(['tallas.id', 'tallas.nombre']) // La lista de columnas se pasa como un array
->from('productos')
->join('RIGHT JOIN', 'tallas', 'tallas.id = productos.genero_id'); 
// Ejecutar la consulta y obtener los datos
$data = $query_tallas->all();
// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out_tallas = [];
foreach ($data as $d) {
    $out_tallas[$d['id']]  = $d['nombre'];
}
?>

<div class="productos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Precio')->textInput() ?>

    <?= $form->field($model, 'Tallas_Id')->dropDownList($out_tallas) ?>

    <?= $form->field($model, 'CategoriaProductos_Id')->dropDownList($out) ?>

    <?= $form->field($model, 'Genero_Id')->dropDownList($out_genero) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
