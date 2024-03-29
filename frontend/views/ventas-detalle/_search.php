<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\VentasDetalleSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ventas-detalle-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Cantidad') ?>

    <?= $form->field($model, 'PrecioProducto') ?>

    <?= $form->field($model, 'Total') ?>

    <?= $form->field($model, 'VentasEncabezado_Id') ?>

    <?php // echo $form->field($model, 'Productos_id') ?>

    <?php // echo $form->field($model, 'Tallas_Id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
