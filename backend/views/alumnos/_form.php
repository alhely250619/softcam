<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Alumnos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alumnos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Matricula')->textInput() ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sexo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">

    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary', 'style'=> 'background-color: #3498DB;',  'onclick' => 'exito()']) ?>
   
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
