<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ProductosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="productos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Nombre') ?>

    <?= $form->field($model, 'Precio') ?>

    <?= $form->field($model, 'Genero') ?>

    <?= $form->field($model, 'Tallas_Id') ?>

    <?php // echo $form->field($model, 'CategoriaProductos_Id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
