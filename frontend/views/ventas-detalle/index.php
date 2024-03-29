<?php

use app\models\VentasDetalle;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\VentasDetalleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ventas Detalles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ventas-detalle-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ventas Detalle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Cantidad',
            'PrecioProducto',
            'Total',
            'VentasEncabezado_Id',
            //'Productos_id',
            //'Tallas_Id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, VentasDetalle $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Id' => $model->Id, 'Tallas_Id' => $model->Tallas_Id]);
                 }
            ],
        ],
    ]); ?>


</div>
