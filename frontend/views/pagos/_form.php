<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pagos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pagos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Concepto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Monto')->textInput() ?>

    <?= $form->field($model, 'MetodoPago')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VentasEncabezado_Id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
