<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\VentasDetalle $model */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Ventas Detalles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ventas-detalle-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Id' => $model->Id, 'Tallas_Id' => $model->Tallas_Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Id' => $model->Id, 'Tallas_Id' => $model->Tallas_Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'Cantidad',
            'PrecioProducto',
            'Total',
            'VentasEncabezado_Id',
            'Productos_id',
            'Tallas_Id',
        ],
    ]) ?>

</div>