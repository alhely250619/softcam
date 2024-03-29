<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\VentasDetalle $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ventas-detalle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Cantidad')->textInput() ?>

    <?= $form->field($model, 'PrecioProducto')->textInput() ?>

    <?= $form->field($model, 'Total')->textInput() ?>

    <?= $form->field($model, 'VentasEncabezado_Id')->textInput() ?>

    <?= $form->field($model, 'Productos_id')->textInput() ?>

    <?= $form->field($model, 'Tallas_Id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
