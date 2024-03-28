<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\VentasEncabezado $model */

$this->title = 'Create Ventas Encabezado';
$this->params['breadcrumbs'][] = ['label' => 'Ventas Encabezados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ventas-encabezado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
