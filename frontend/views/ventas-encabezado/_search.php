<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\VentasEncabezadoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ventas-encabezado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Fecha') ?>

    <?= $form->field($model, 'Total') ?>

    <?= $form->field($model, 'Estatus') ?>

    <?= $form->field($model, 'Alumnos_Id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
