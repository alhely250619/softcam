<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\VentasDetalle $model */

$this->title = 'Modificar producto';
$this->params['breadcrumbs'][] = ['label' => 'Ventas Detalles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="ventas-detalle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
