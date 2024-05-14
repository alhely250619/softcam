<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Pagos $model */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pagos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'Monto',
            'VentasEncabezado_Id',
            'Conceptos_Id',
            'FechaHora_create',
            'MetodoPago_Id',
            'FechaHora_update',
        ],
    ])?>