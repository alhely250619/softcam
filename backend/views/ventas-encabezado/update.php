<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\VentasEncabezado $model */

$this->title = 'Update Ventas Encabezado: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Ventas Encabezados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>



<div >
    <div class="ventas-encabezado-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'detalleModel'=>$detalleModel,
        ]) ?>

    </div>
</div>
