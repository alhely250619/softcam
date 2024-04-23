<?php

use app\models\CategoriaProductos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\CategoriaProductosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Categoria Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-productos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Categoria Productos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Nombre',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CategoriaProductos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Id' => $model->Id]);
                 }
            ],
        ],
    ]); ?>


</div>
