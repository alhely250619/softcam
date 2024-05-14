<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Genero $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="genero-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'onclick' => 'exito()']) ?>
    </div>
    <script>
    function exito(){
        swal({
        title: "Registro Guardado!",
        text: "Exitosamente!",
        icon: "success",
        button: "Cerrar!"
        });
    }
    </script>


    <?php ActiveForm::end(); ?>

</div>
