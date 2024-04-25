<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PagosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pagos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Monto') ?>

    <?= $form->field($model, 'VentasEncabezado_Id') ?>

    <?= $form->field($model, 'Conceptos_Id') ?>

    <?= $form->field($model, 'FechaHora_create') ?>

    <?php // echo $form->field($model, 'MetodoPago_Id') ?>

    <?php // echo $form->field($model, 'FechaHora_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
