<?php

use app\models\Productos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\RecordHelpers;

/** @var yii\web\View $this */
/** @var backend\models\ProductosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Producto', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Folio',
            'Nombre',
            'Precio',
            [
                'label' => 'Talla',
                'value' => function ($searchProductos) {
                return $searchProductos->tallas->Nombre;
                }
            ],
            [
                'label' => 'Categoria del Producto',
                'value' => function ($searchCat) {
                return $searchCat->categoriaProductos->Nombre;
                }
            ],
               
            //'Genero_Id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Productos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Id' => $model->Id]);
                 }
            ],
        ],
    ]); ?>

</div>
