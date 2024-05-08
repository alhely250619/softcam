<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\VentasEncabezadoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ventas-encabezado-search" id="page-wrapper" ng-app="ventaApp" ng-controller="VentasController">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Fecha_create') ?>

    <?= $form->field($model, 'Total') ?>

    <?= $form->field($model, 'Estatus') ?>

    <?= $form->field($model, 'Alumnos_Id') ?>

    <?php // echo $form->field($model, 'Fecha_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
